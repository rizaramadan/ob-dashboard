<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi budget comparison
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @author     Winda Prihatin <winda@wiradipa.com>
	 * @version    1.0
	 */

	include "dbcon.php";	
	include "QueryManager.php";
 	include "Utils.php";

	if(isset($_GET['budget1'])){
			//ketika $_GET['budget1'] ada nilainya
			$budget1 = getCleanParam($_GET,'budget1');
			$budget2 = getCleanParam($_GET,'budget2');
		}else{
			//ketika $_GET['budget1'] tidak ada nilainya, $budget1 dan $budget2 disi nilai default
			$result_c_budget = pg_exec($dbconn,"select * from c_budget order by created desc limit 1");
			$row_c_budget = pg_fetch_array($result_c_budget);
			$budget1 = $row_c_budget['c_budget_id'];
			$budget2 = $row_c_budget['c_budget_id'];
	}

	
	$project_id = getCleanParam($_GET,'project');
	$budget_id = getCleanParam($_GET,'budget');
	
	$currency = $_GET['currency'];
	

	
	$result = pg_exec($dbconn,  getBudgetVsCostQuery($project_id, $budget_id));
	
  	$numrows = pg_numrows($result); 

	//$data = array(); 
	$rawData = array();
    while($row = pg_fetch_array($result)) {
		//$rowProjectName = $row['project_name'];
		array_push($rawData, $row);
	}  
	
	$table = "";
	//print_r($rawData);
	$table.= '<table border="1" cellpadding="10" cellspacing="0" style="width:100%" class="budgetcost">';
	$table.= '<tr><th>Project</th><th>Group</th><th>Phase</th><th>Task</th><th>First Budget</th><th>Second Budget</th></tr>';
	$lastBudget = "";
	$lastProject = "";
	$lastGroup= "";
	$lastPhase = "";
	$lastTask = "";
	
	
	for($i = 0; $i < count($rawData); ++$i) {
		$table.='<tr>';
		
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
		
		switch ($currency) {
			case 'usd':
					$firstBudget = getBudgetValueUSD($dbconn, $budget1, $rawData[$i]['c_project_id'], $rawData[$i]['c_projectphase_id'], $rawData[$i]['project_task']);
							$secondBudget = getBudgetValueUSD($dbconn, $budget2, $rawData[$i]['c_project_id'], $rawData[$i]['c_projectphase_id'], $rawData[$i]['project_task']);
				break;
			default:
				$firstBudget = getBudgetValue($dbconn, $budget1, $rawData[$i]['c_project_id'], $rawData[$i]['c_projectphase_id'], $rawData[$i]['project_task']);
							$secondBudget = getBudgetValue($dbconn, $budget2, $rawData[$i]['c_project_id'], $rawData[$i]['c_projectphase_id'], $rawData[$i]['project_task']);
				break;
		}
		
		
		
		$table.="<td>".$firstBudget."</td>";
		$table.="<td>".$secondBudget."</td>";
		
		$table.='</tr>';
	}
	$table.='</table>';
	
	
	// free memory
	pg_free_result($result);
	// close connection
	pg_close($dbconn);
	//
	//echo 'project<br />';
	//print_r($projects);
	//echo json_encode($projects);
	//echo '</pre>';
	
	//echo $_GET['callback'] . '(' . $table. ')';
	echo $table;
