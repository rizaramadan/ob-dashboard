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

	$budget1 = getCleanParam($_GET,'budget1');
	$budget2 = getCleanParam($_GET,'budget2');

	$project_id = getCleanParam($_GET,'project');
	$budget_id = getCleanParam($_GET,'budget');
	
	$result = pg_exec($dbconn,  getBudgetComparison($budget1,$budget2,$project_id));

  	$numrows = pg_numrows($result); 

	$rawData = array();
    while($row = pg_fetch_array($result)) {
		array_push($rawData, $row);
	}

function sumBudget($r_source,$item){
    $total = 0;
    foreach($r_source as $val){
        $total += $val->$item;
    }
    return $total;
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
                $temp = array("id" => $level1['c_project_id'],"name" => $level1['project_name']);
                array_push($r_project_id,$level1['c_project_id']);
                array_push($project,$temp);
    }}}

    $r_phasegroup_id = array();
    $phasegroup = array();
    foreach($rawData as $group){
        if(in_array($group['c_budget_id'],$r_budget_id,true)){
            if(in_array($group['c_project_id'],$r_project_id,true)){
                if(!(in_array($group['em_pjt_phasegroup_id'],$r_phasegroup_id,true))){
                    $temp = array('id'=>$group['em_pjt_phasegroup_id'],'name' => $group['group_name']);
                    array_push($r_phasegroup_id,$group['em_pjt_phasegroup_id']);
                    array_push($phasegroup,$temp);
    }}}}

    $r_phase_id = array();
    $phase = array();
    foreach($rawData as $level2){
        if(in_array($level2['c_budget_id'],$r_budget_id,true)){
            if(in_array($level2['c_project_id'],$r_project_id,true)){
                if(in_array($level2['em_pjt_phasegroup_id'],$r_phasegroup_id,true)){
                    if(!(in_array($level2['c_projectphase_id'],$r_phase_id,true))){
                        $temp = array('group_id'=>$level2['em_pjt_phasegroup_id'],'project_id' => $level2['c_project_id'],'id' => $level2['c_projectphase_id'],'name' => $level2['phase_name']);
                        array_push($r_phase_id,$level2['c_projectphase_id']);
                        array_push($phase,$temp);
    }}}}}

    $r_task_id = array();
    $task = array();

    foreach($rawData as $level3){
         if(in_array($level3['c_budget_id'],$r_budget_id,true)){
            if(in_array($level3['c_project_id'],$r_project_id,true)){
                if(in_array($level3['c_projectphase_id'],$r_phase_id,true)){
                    if(!(in_array($level3['project_task'],$r_task_id,true))){
                        $temp_b1 = $level3['budget1'];
                        $temp_b2 = $level3['budget2'];
                        if($level3['budget1']==null){$temp_b1=0;}
                        if($level3['budget2']==null){$temp_b2=0;}

                        $temp = array(
                            'group_id'=>$level3['em_pjt_phasegroup_id'],
                            'phase_id'=>$level3['c_projectphase_id'],
                            'id' => $level3['project_task'],
                            'name' => $level3['task_name'],
                            'budget_1' => $temp_b1,
                            'budget_2' => $temp_b2
                        );
                        array_push($r_task_id,$level3['project_task']);
                        array_push($task,$temp);

    }}}}}

//=================create json=====================
$dummy_budgets = array();
$dum_dum_projects = array();
$dum_projects = array();
$dum_budget = new stdClass();
for($i=0; $i<count($budget); $i++){
    $dum_budget->id = $budget[$i]['id'];
    $dum_budget->name = $budget[$i]['name'];


    for($j=0; $j<count($project); $j++){
        $dum_project = new stdClass();
        $dum_project->id=$project[$j]['id'];
        $dum_project->name=$project[$j]['name'];
       $dum_groups = array();
        foreach($phasegroup as $g){
                $dum_group = new stdClass();
                $dum_group->id = $g['id'];
                $dum_group->name = $g['name'];
                $dum_phases = array();
                foreach($phase as $k){
                    if($k['project_id']==$project[$j]['id'] && $k['group_id']==$g['id']){
                        $dum_phase = new stdClass();
                        $dum_phase->id=$k['id'];
                        $dum_phase->name = $k['name'];
                        $dum_tasks = array();
                        foreach($task as $l){
                            if($l['group_id']==$k['group_id'] && $l['phase_id']==$k['id']){
                                $dum_task = new stdClass();
                                $dum_task->group_id = $k['group_id'];
                                $dum_task->phase_id = $k['id'];
                                $dum_task->id = $l['id'];
                                $dum_task->name = $l['name'];
                                $dum_task->budget_1 = $l['budget_1'];
                                $dum_task->budget_2 = $l['budget_2'];
                                $dum_tasks[]=$dum_task;
                            }
                        }
                        $dum_phase->budget_1 = sumBudget($dum_tasks,'budget_1');
                        $dum_phase->budget_2 = sumBudget($dum_tasks,'budget_2');
                        $dum_phase->children = $dum_tasks;
                        $dum_phases[]=$dum_phase;
                    }
                }
                $dum_group->budget_1 = sumBudget($dum_phases,'budget_1');
                $dum_group->budget_2 = sumBudget($dum_phases,'budget_2');
                $dum_group->children = $dum_phases;
                $dum_groups[]=$dum_group;
        }
       $dum_project->budget_1 = sumBudget($dum_groups,'budget_1');
       $dum_project->budget_2 = sumBudget($dum_groups,'budget_2');
       $dum_project->children = $dum_groups;
       $dum_projects[]=$dum_project;
    }
}
$dum_budget->budget_1 = sumBudget($dum_projects,'budget_1');
$dum_budget->budget_2 = sumBudget($dum_projects,'budget_2');
$dum_budget->children = $dum_projects;
$dummy_budgets[] = $dum_budget;

//echo $_GET['callback2'] . '<pre>(' . json_encode($dummy_budgets,JSON_PRETTY_PRINT) . ')</pre>';
echo $_GET['callback2'] . '(' . json_encode($dummy_budgets) . ')';

// free memory
pg_free_result($result);
// close connection
pg_close($dbconn);
?>