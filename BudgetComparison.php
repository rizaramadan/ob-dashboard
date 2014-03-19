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
	
	$result = pg_exec($dbconn,  getBudgetComparison($budget1,$budget2,$project_id));
	
  	$numrows = pg_numrows($result); 

	//$data = array(); 
	$rawData = array();
    while($row = pg_fetch_array($result)) {
		//$rowProjectName = $row['project_name'];
		array_push($rawData, $row);
	}  
	//========================================================== Kategorisasi =====================================
	$r_budget_id = array();
	$budget = array();
	foreach($rawData as $level0){
		if(!(in_array($level0['c_budget_id'],$r_budget_id,true))){
			$temp = array("id" => $level0['c_budget_id'],"name" => $level0['budget_name']);
			array_push($r_budget_id, $level0['c_budget_id']);
			array_push($budget,$temp);
	}}

    $r_project_id = array();
    $project = array();
    foreach($rawData as $level1){
        if(in_array($level1['c_budget_id'],$r_budget_id,true)){
            if(!(in_array($level1['c_project_id'],$r_project_id,true))){
                $temp = array("id"   => $level1['c_project_id'],"name" => $level1['project_name']);
                array_push($r_project_id,$level1['c_project_id']);
                array_push($project,$temp);
    }}}

    $r_phase_id = array();
    $phase = array();
    foreach($rawData as $level2){
        if(in_array($level2['c_budget_id'],$r_budget_id,true)){
            if(in_array($level2['c_project_id'],$r_project_id,true)){
                if(!(in_array($level2['c_projectphase_id'],$r_phase_id,true))){
                    $temp = array('project_id' => $level2['c_project_id'],'id' => $level2['c_projectphase_id'],'name' => $level2['phase_name']);
                    array_push($r_phase_id,$level2['c_projectphase_id']);
                    array_push($phase,$temp);
    }}}}

    $r_task_id = array();
    $task = array();

    foreach($rawData as $level3){
         if(in_array($level3['c_budget_id'],$r_budget_id,true)){
            if(in_array($level3['c_project_id'],$r_project_id,true)){
                if(in_array($level3['c_projectphase_id'],$r_phase_id,true)){
                    if(!(in_array($level3['project_task'],$r_task_id,true))){
                        $temp = array('phase_id'=>$level3['c_projectphase_id'],'id' => $level3['project_task'], 'name' => $level3['task_name']);
                        array_push($r_task_id,$level3['project_task']);
                        array_push($task,$temp);
                    }
                }
            }
         }
    }

//=================create json=====================

$dum_budget = new stdClass();


$dum_projects = array();
$dum_tasks = array();

for($i=0; $i<count($budget); $i++){
    $dum_budget->id = $budget[$i]['id'];
    $dum_budget->name = $budget[$i]['name'];

   for($j=0; $j<count($project); $j++){
        $dum_project = new stdClass();
        $dum_project->id=$project[$j]['id'];
        $dum_project->name=$project[$j]['name'];
        $dum_phases = array();
       foreach($phase as $k){
           if($k['project_id']==$project[$j]['id']){
               $dum_phase = new stdClass();
               $dum_phase->id=$k['id'];
               $dum_phase->name = $k['name'];
               foreach($task as $l){
                   if($l['phase_id']==$k['id']){
                       $dum_task = new stdClass();
                       $dum_task->id = $l['id'];
                       $dum_task->name = $l['name'];
                       $dum_tasks[]=$dum_task;
                   }
               }
               $dum_phase->children = $dum_tasks;
               $dum_phases[]=$dum_phase;
           }
       }
       $dum_project->children = $dum_phases;
       $dum_projects[]=$dum_project;
    }

}
$dum_budget->children = $dum_projects;

//for($k=0; $k<count($phase); $k++){
//    for($l=0; $l<count($task); $l++){
//
//    }
//}

    echo $_GET['callback2'] . '<pre>(' . json_encode($dum_budget,JSON_PRETTY_PRINT) . ')</pre>';
	//print_r($phase);
    exit;
	
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
		
		$firstBudget = getBudgetValue($dbconn, $budget1, $rawData[$i]['c_project_id'], $rawData[$i]['c_projectphase_id'], $rawData[$i]['project_task']);
		$secondBudget = getBudgetValue($dbconn, $budget2, $rawData[$i]['c_project_id'], $rawData[$i]['c_projectphase_id'], $rawData[$i]['project_task']);
		
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
