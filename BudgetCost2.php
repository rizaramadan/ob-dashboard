<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi budget vs cost table
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @author     Winda Prihatin <winda@wiradipa.com>
	 * @version    1.0
	 */
	 
	include "dbcon.php";
	include "QueryManager.php";
 	include "Utils.php";
	
	$project_id = getCleanParam($_GET,'project');
	$budget_id = getCleanParam($_GET,'budget');

	
	$result = pg_exec($dbconn,  getBudgetVsCostQuery($project_id, $budget_id));
	
  	$numrows = pg_numrows($result); 

	//$data = array(); 
	$rawData = array();
    while($row = pg_fetch_array($result)) {
		//$rowProjectName = $row['project_name'];
		array_push($rawData, $row);
	}  
	
	//masukkin2 project
	$projects = array();
	for($i = 0; $i < count($rawData); ++$i){
		if(!array_key_exists($rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'], $projects)) {
			$eachProject = array("id"=>$rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'],"name" => $rawData[$i]['project_name'],'budget_id' => $rawData[$i]['c_budget_id'], '2010' => '0', '2011' => '0', '2012' => '0', '2013' => '0', '2014' => '0', '2015' => '0' , 'balance' => '0', 'groups' => array() );
			$projects[$rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id']] = $eachProject;
		}
	}
	
	//ambil group
	$phaseGroup = array();
	for($i = 0; $i < count($rawData); ++$i){
		if(!array_key_exists($rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id'], $phaseGroup)) {
			$eachPhaseGroup = array("id"=>$rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id'],"parent_id"=>$rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'], "group_id" => $rawData[$i]['em_pjt_phasegroup_id'],'name'=>$rawData[$i]['group_name'],
									'budget_id' => $rawData[$i]['c_budget_id'], '2010' => '0', '2011' => '0', '2012' => '0', '2013' => '0', '2014' => '0', '2015' => '0' , 'balance' => '0', 'phases' => array() );
			$phaseGroup[$rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id']] = $eachPhaseGroup;
			
			$projects[$eachPhaseGroup['parent_id']]["groups"][$eachPhaseGroup['id']] = $eachPhaseGroup;
		}
		
	}
	
	//ambil fase
	$phase = array();
	for($i = 0; $i < count($rawData); ++$i){
		if(!array_key_exists($rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id'].$rawData[$i]['c_projectphase_id'], $phase)) {
			$eachPhase = array("id"=>$rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id'].$rawData[$i]['c_projectphase_id'],"parent_id"=>$rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id'],
				"group_id"=> $rawData[$i]['em_pjt_phasegroup_id'],"phase_id" => $rawData[$i]['c_projectphase_id'],'name'=>$rawData[$i]['phase_name'],'budget_id' => $rawData[$i]['c_budget_id'], '2010' => '0', '2011' => '0', '2012' => '0', '2013' => '0', '2014' => '0', '2015' => '0' , 
				'balance' => '0',"tasks" =>array());
			$phase[$rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id'].$rawData[$i]['c_projectphase_id']] = $eachPhase;
			
			//array_push( $phaseGroup[$eachPhase['parent_id']]["phases"] , $eachPhase);
			$projects[ $rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'] ]['groups'][$eachPhase['parent_id'] ]['phases'][$eachPhase['id'] ] = $eachPhase;
		}
	}
	
	//ambil task
	$task = array();
	for($i = 0; $i < count($rawData); ++$i){
		if(!array_key_exists($rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id'].$rawData[$i]['c_projectphase_id'].$rawData[$i]['project_task'], $task)) {
			$eachTask = array("id"=> $rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id'].$rawData[$i]['c_projectphase_id'].$rawData[$i]['project_task'],
							  "parent_id"=>$rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id'].$rawData[$i]['c_projectphase_id'], "task_id" => $rawData[$i]['project_task'],'name'=>$rawData[$i]['task_name'],'budget_id' => $rawData[$i]['c_budget_id'], 
							  $rawData[$i]['actualyear'] => $rawData[$i]['amount'],'2010' => '0', '2011' => '0', '2012' => '0', '2013' => '0', '2014' => '0', '2015' => '0' , 'balance' => '0');
			$task[ $rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id'].$rawData[$i]['c_projectphase_id'].$rawData[$i]['project_task'] ] = $eachTask;
		} else {
			$eachTask = $task[$rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id'].$rawData[$i]['c_projectphase_id'].$rawData[$i]['project_task']];
			$amountYear = $eachTask[$rawData[$i]['actualyear']];
			if( !isset($amountYear) || $amountYear == '' ) {
				$amountYear = 0;
			}
			if(isset($rawData[$i]['amount'])) {$amountYear += $rawData[$i]['amount'];}
			$eachTask[$rawData[$i]['actualyear']] = $amountYear;
		}
		$projects[ $rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'] ]['groups'][ $rawData[$i]['c_budget_id'].$rawData[$i]['c_project_id'].$rawData[$i]['em_pjt_phasegroup_id']  ]['phases'][$eachTask['parent_id']]['tasks'][ $eachTask['id'] ] = $eachPhase;
	}
	
	//echo "<pre>";
	//echo json_encode($projects, JSON_PRETTY_PRINT);
	//echo "<pre>";
	
	$table = "";
	//print_r($rawData);
	$table.= '<table border="1" cellpadding="10" cellspacing="0" style="width:100%" class="budgetcost">';
	$table.= '<tr><th>Budget</th><th>Project</th><th>Group</th><th>Phase</th><th>Task</th><th>Total Budget</th><th>2010</th><th>2011</th><th>2012</th><th>2013</th><th>2014</th><th>2015</th><th>Balance</th></tr>';
	$lastBudget = "";
	$lastProject = "";
	$lastGroup= "";
	$lastPhase = "";
	$lastTask = "";
	
	
	for($i = 0; $i < count($rawData); ++$i) {
		$table.='<tr>';
		
		if($lastBudget != $rawData[$i]['budget_name']) {
			$table.= "<th class='nobg'>".$rawData[$i]['budget_name']."</th>";
			$lastProject = "";$lastGroup= "";$lastPhase = "";$lastTask = "";
		} else {
			$table.="<th class='nobg'>&nbsp;</th>";
		}
		$lastBudget = $rawData[$i]['budget_name'];
		
		if($lastProject != $rawData[$i]['project_name']) {
			$table.="<td>".$rawData[$i]['project_name']."</td>";
			$lastGroup= "";$lastPhase = "";$lastTask = "";
		} else {
			$table.="<td>&nbsp;</td>";
		}
		$lastProject = $rawData[$i]['project_name'];
		
		if($lastGroup != $rawData[$i]['group_name']) {
			$table.="<td>".$rawData[$i]['group_name']."</td>";
			$lastPhase = "";$lastTask = "";
		} else {
			$table.="<td>&nbsp;</td>";
		}
		$lastGroup = $rawData[$i]['group_name'];
		
		if($lastPhase != $rawData[$i]['phase_name']) {
			$table.="<td>".$rawData[$i]['phase_name']."</td>";
			$lastTask = "";
		} else {
			$table.="<td>&nbsp;</td>";
		}
		$lastPhase = $rawData[$i]['phase_name'];
		
		$table.="<td>".$rawData[$i]['task_name']."</td>";
		$table.="<td>".$rawData[$i]['amountbudget']."</td>";
		$v2010 = getActualYearAmount($dbconn, $rawData[$i]['c_budget_id'], $rawData[$i]['c_project_id'], $rawData[$i]['c_projectphase_id'], $rawData[$i]['project_task'], '2010');
		$v2011 = getActualYearAmount($dbconn, $rawData[$i]['c_budget_id'], $rawData[$i]['c_project_id'], $rawData[$i]['c_projectphase_id'], $rawData[$i]['project_task'], '2011');
		$v2012 = getActualYearAmount($dbconn, $rawData[$i]['c_budget_id'], $rawData[$i]['c_project_id'], $rawData[$i]['c_projectphase_id'], $rawData[$i]['project_task'], '2012');
		$v2013 = getActualYearAmount($dbconn, $rawData[$i]['c_budget_id'], $rawData[$i]['c_project_id'], $rawData[$i]['c_projectphase_id'], $rawData[$i]['project_task'], '2013');
		$v2014 = getActualYearAmount($dbconn, $rawData[$i]['c_budget_id'], $rawData[$i]['c_project_id'], $rawData[$i]['c_projectphase_id'], $rawData[$i]['project_task'], '2014');
		$v2015 = getActualYearAmount($dbconn, $rawData[$i]['c_budget_id'], $rawData[$i]['c_project_id'], $rawData[$i]['c_projectphase_id'], $rawData[$i]['project_task'], '2015');
		$table.="<td>".$v2010."</td>";
		$table.="<td>".$v2011."</td>";
		$table.="<td>".$v2012."</td>";
		$table.="<td>".$v2013."</td>";
		$table.="<td>".$v2014."</td>";
		$table.="<td>".$v2015."</td>";
		
		$amountBudget = $rawData[$i]['amountbudget'];
		if(isset($amountBudget) && $amountBudget > 0) {
			$balance = ($amountBudget - ($v2010 + $v2011 + $v2012 + $v2013 + $v2014 + $v2015) ) / $amountBudget * 100;
			$table.="<td>".round($balance)." %</td>";
		} else {
			$table.="<td>No Budget Available</td>";
		}
		
		$table.='</tr>';
	}
	$table.='</table>';
	
	
	// free memory
	pg_free_result($result);
	// close connection
	pg_close($dbconn);
	//echo '<pre>';
	//echo 'project<br />';
	//print_r($projects);
	//echo json_encode($projects);
	//echo '</pre>';
	$noData = array();
	
	//echo $_GET['callback'] . '(' . $table. ')';
	echo $table;
