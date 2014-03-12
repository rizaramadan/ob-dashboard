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
	$dummy = true;
	
	
	$result = pg_exec($dbconn,  getBudgetVsCostQuery($project_id, $budget_id));
  	$numrows = pg_numrows($result); 
	
	/* real data
	$budgets = array();
	$projects = array();
	$budgets[] = projects;
	$phases = array();
	$tasks = array();
	
    while($row = pg_fetch_array($result)) {
		$budgets[$row['c_budget_id']][$row['c_project_id']][$row['c_projectphase_id']][$row['c_projecttask']] = $budget;
	}  
	*/
	
	
	function getTotalPhaseFromTask($array){
		$total = 0;
		foreach($array as $arr){
			$total += $arr->TOTAL;
		}
		return $total;
	}
	
	function get2010PhaseFromTask($array){
		$total = 0;
		foreach($array as $arr){
			$total += $arr->Tahun_2010;
		}
		return $total;
	}
	
	function get2011PhaseFromTask($array){
		$total = 0;
		foreach($array as $arr){
			$total += $arr->Tahun_2011;
		}
		return $total;
	}
	
	
	function get2012PhaseFromTask($array){
		$total = 0;
		foreach($array as $arr){
			$total += $arr->Tahun_2012;
		}
		return $total;
	}
	
	
	function get2013PhaseFromTask($array){
		$total = 0;
		foreach($array as $arr){
			$total += $arr->Tahun_2013;
		}
		return $total;
	}
	
	
	function get2014PhaseFromTask($array){
		$total = 0;
		foreach($array as $arr){
			$total += $arr->Tahun_2014;
		}
		return $total;
	}
	
	
	function get2015PhaseFromTask($array){
		$total = 0;
		foreach($array as $arr){
			$total += $arr->Tahun_2015;
		}
		return $total;
	}
	
	$dummy_budgets = array();
	/* start loop 0 */
	$budget = new stdClass;
	$budget->BUDGET = 'Budget Version 1';
	$budget->GROUP = "";
	
		$projects = array();
		/* start loop 1 */
		$project = new stdClass;
		$project->PROJECT = "CIBIS9";
		
			$phases = array();
			/* start loop 2 */
			$phase = new stdClass;
			$phase->PHASE = "Feasibility Study";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Appraisal Work";
				$task->TOTAL = 1729.39;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 135;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = 0;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Feasibility Study";
				$task->TOTAL = 530;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 1443.84;
				$task->Tahun_2013 = 21;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // getTotalPhaseFromTask($tasks);
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // get2010PhaseFromTask($tasks);
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // get2011PhaseFromTask($tasks);
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // get2012PhaseFromTask($tasks);
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // get2013PhaseFromTask($tasks);
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // get2014PhaseFromTask($tasks);
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // get2015PhaseFromTask($tasks);
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			
			
			
			$phase = new stdClass;
			$phase->PHASE = "Master Planning";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Concept and Schematic";
				$task->TOTAL = 2778.313;
				$task->Tahun_2010 = 141.024;
				$task->Tahun_2011 = 1897.659289;
				$task->Tahun_2012 = 583.68;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 2778.313;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 141.024;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 1897.659289;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 583.68;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Design Development";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Consept Design";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Planning Development Stage";
				$task->TOTAL = 2120;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Tender Document Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Construction Stage";
				$task->TOTAL = 1000;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			
			$phase = new stdClass;
			$phase->PHASE = "Infrastructure";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Concept Design";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Planning Development Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Tender Document Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Construction Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			
			$phase = new stdClass;
			$phase->PHASE = "Facade";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Schematic Design Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Design Development Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Tender Document Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Tender Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Performance Mock-Up Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Shop Drawing & Engineering Review Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Fabrication and Installation Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Hand Over Stage";
				$task->TOTAL = 68.25;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 68.25;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			
			$phase = new stdClass;
			$phase->PHASE = "Structure and Civil Engineering";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Concept Design";
				$task->TOTAL = 68.25;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 30.75;
				$task->Tahun_2012 = 37.5;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Planning Development Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Tender Document Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Construction Stage";
				$task->TOTAL = 500;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 568.25;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
				
			$phase = new stdClass;
			$phase->PHASE = "Mechanical,  Electrical and Plumbing";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Design Concept";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Design Schematic";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Design Development";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Detail Design % Document ";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Tender Phase";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Construction Stage";
				$task->TOTAL = 100;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */

				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 100;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Maket/Model";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Maket/Model";
				$task->TOTAL = 310;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 310;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Soil Test";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Factual Investigation";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "SSRA Study";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 212.5;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Geotechnical Design Report";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 85;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "TPKB Permission Approval";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Survey-Topography";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Topography Survey";
				$task->TOTAL = 122.96;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 35;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Quantity Surveyor";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Project Concept Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 73.71;
				$task->Tahun_2012 = 49.25;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Documentation Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Tender Phase and Contract Award";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Monthly Construction Phase";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Final Account";
				$task->TOTAL = 350;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Interior";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Concept Design";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Planning Development Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Tender Document Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Construction Stage";
				$task->TOTAL = 275;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Special Lighting";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Design Concept";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Design Development";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Tender Documentation";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Construction Administration";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Interior";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Design Concept";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Design Development";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Tender Documentation";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Construction Administration";
				$task->TOTAL = 2000;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Green Consultant";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Schematic Design";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Design Development";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Tender Documentation";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Construction Period";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "LEED Construction Submission";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Amdal";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Completion document for Andal, RKL and RPL";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Completion document legalization for Andal, RKL and RPL";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Security and Risk";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Design Schematic";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Tender Documentation";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Detail Design Documentation";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Utility Connection Fee";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "PLN Connection Fee";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Telkom Connection Fee";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Dirwas";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Dirwas";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Construction Management";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Construction Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Maintainance Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Project Management";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Personel";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = -48.904587;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Operational Overhead";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 194.990812;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Permit and Fee";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Lulus TPAK";
				$task->TOTAL = 5400;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Revisi BLAD";
				$task->TOTAL = 700;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "SIPPT";
				$task->TOTAL = 500;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Pelampauan KLB";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Test Pile";
				$task->TOTAL = 700;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Blok Plan";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "IP Struktur";
				$task->TOTAL = 800;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "IMB Definitif";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Revisi Blaad,  KDB 30 %  dan KLB 3,5";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Pemecah Sertipikat";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "KRK";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "SLF";
				$task->TOTAL = 400;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "KKOP";
				$task->TOTAL = 16.5;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Biaya Notaris";
				$task->TOTAL = 1856;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Izin lain-lain";
				$task->TOTAL = 7004;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Retribution Cost";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "IMB";
				$task->TOTAL = 500;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				$task = new stdClass;
				$task->TASK = "AMDAL";
				$task->TOTAL = 1000;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				$task = new stdClass;
				$task->TASK = "Jalan - PU - Dishub";
				$task->TOTAL = 300;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				$task = new stdClass;
				$task->TASK = "Pajak Reklame - Construction";
				$task->TOTAL = 50;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "NAME/BRANDING/LOGO/COPYRIGHT";
				$task->TOTAL = 249;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Traffic Study";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Draft Traffic Study Report";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Final Traffic Study Report";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			/* end loop 2 */
		
		$project->PHASES = $phases;
		$project->TOTAL = getTotalPhaseFromTask($phases);//1726774700;
		$project->Tahun_2010 = get2010PhaseFromTask($phases);//0;
		$project->Tahun_2011 = get2011PhaseFromTask($phases);//0;
		$project->Tahun_2012 = get2012PhaseFromTask($phases);//0;
		$project->Tahun_2013 = get2013PhaseFromTask($phases);//0;
		$project->Tahun_2014 = get2014PhaseFromTask($phases);//0;
		$project->Tahun_2015 = get2015PhaseFromTask($phases);//0;
		$project->BALANCE = $project->TOTAL - $project->Tahun_2010 - $project->Tahun_2011 - $project->Tahun_2012 - $project->Tahun_2013 - $project->Tahun_2014 - $project->Tahun_2015;//0;
		$projects[] = $project;
		
		
		$project = new stdClass;
		$project->PROJECT = "Estate";
		
			$phases = array();
			/* start loop 2 */

			$phase = new stdClass;
			$phase->PHASE = "Foundation";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Bored Piles";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Bulk Excavation";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Excavations and Site Clearance";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Structural Work";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Backfilling to make up level";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Foundations";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Basement Structure";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Tender Document Stage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Tower Structure";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Architectural Works";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "External Wall and Finishes (brick wall, cement render, painting, etc)";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Window and Doors";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Internal Wall and Partitions";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Wall FInishes";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "External Walls and Finishing";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Floor Finishes";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Ceiling Finishes";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Sanitary Appliances";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Facade";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Façade (Glass, Frame, Sun Shade, ACP)";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Stone Work";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Wall Stone Works (Granit and Marble";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Floor Stone Works (Granit and Marble";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Furniture and Equipment";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Fittings, Furnitures and Equipment (FF&E).";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Signage";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Signage, Graphic,s, and Functon Equipment";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "MEP";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Plumbing Installations";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Fire Protection and Detection";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Electrical Installation";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Minor Bulding MEP";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "External MEP";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Special Lighting";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Special Lighting";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "MVAC";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Air COnditioning and Ventilation";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Electronic and Secutiry System";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Communication and Security Installation";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;

				$task = new stdClass;
				$task->TASK = "Vertical Transportation Installation";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Elevator and Escalator";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Elevator and Escalator";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Gondola System";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Gondola";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			
			$phase = new stdClass;
			$phase->PHASE = "Genset Installation";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Stanby power generator installations (8000 kVA).";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Utility";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "PLN Electrical Supply";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "PDAM Water Supply";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Deep Well Installation";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Water Treatment Plant";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Sewage Treatment Plant";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Drainage Outfall";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "TELKOM Telephone Lines";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Builder's work in connection with utilities.";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Infrastructure";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Minor Building (F & B and Miscelaneous Minor Building)";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Covered Way";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Hardscaping";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Stormwater drainage";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Elevated Road";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Landscaping";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Softscaping/Landscaping";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "BWIC and Main Contractors Attendance";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "BWIC and Main Contractors Attendance";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Preliminaries";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Preliminaries 6%";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Insurance";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Insurance 0.1%";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Contingency";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Contingency";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "PPN";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "PPN 10%";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;

			$phase = new stdClass;
			$phase->PHASE = "Cost of Fund";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Bank Interest";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Bank Provision";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				
				$task = new stdClass;
				$task->TASK = "Financial Advisor";
				$task->TOTAL = 0;
				$task->Tahun_2010 = 0;
				$task->Tahun_2011 = 0;
				$task->Tahun_2012 = 0;
				$task->Tahun_2013 = 0;
				$task->Tahun_2014 = 0;
				$task->Tahun_2015 = 0;
				$task->BALANCE = $task->TOTAL - $task->Tahun_2010 - $task->Tahun_2011 - $task->Tahun_2012 - $task->Tahun_2013 - $task->Tahun_2014 - $task->Tahun_2015;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = getTotalPhaseFromTask($tasks); // 0;
			$phase->Tahun_2010 = get2010PhaseFromTask($tasks); // 0;
			$phase->Tahun_2011 = get2011PhaseFromTask($tasks); // 0;
			$phase->Tahun_2012 = get2012PhaseFromTask($tasks); // 0;
			$phase->Tahun_2013 = get2013PhaseFromTask($tasks); // 0;
			$phase->Tahun_2014 = get2014PhaseFromTask($tasks); // 0;
			$phase->Tahun_2015 = get2015PhaseFromTask($tasks); // 0;
			$phase->BALANCE = $phase->TOTAL - $phase->Tahun_2010 - $phase->Tahun_2011 - $phase->Tahun_2012 - $phase->Tahun_2013 - $phase->Tahun_2014 - $phase->Tahun_2015;//"No Budget Available";
			$phases[] = $phase;
			/* end loop 2 */
		
		$project->PHASES = $phases;
		$project->TOTAL = getTotalPhaseFromTask($phases);//getTotalPhaseFromTask($phases);
		$project->Tahun_2010 = get2010PhaseFromTask($phases);//0;
		$project->Tahun_2011 = get2011PhaseFromTask($phases);//0;
		$project->Tahun_2012 = get2012PhaseFromTask($phases);//0;
		$project->Tahun_2013 = get2013PhaseFromTask($phases);//0;
		$project->Tahun_2014 = get2014PhaseFromTask($phases);//0;
		$project->Tahun_2015 = get2015PhaseFromTask($phases);//0;
		$project->BALANCE = $project->TOTAL - $project->Tahun_2010 - $project->Tahun_2011 - $project->Tahun_2012 - $project->Tahun_2013 - $project->Tahun_2014 - $project->Tahun_2015;//0;
		$projects[] = $project;
		/* end loop 1 */
	
	$budget->projects = $projects;
	
	$budget->TOTAL = getTotalPhaseFromTask($projects); 
	$budget->Tahun_2010 = get2010PhaseFromTask($projects);
	$budget->Tahun_2011 = get2011PhaseFromTask($projects);//0;
	$budget->Tahun_2012 = get2012PhaseFromTask($projects);//0;
	$budget->Tahun_2013 = get2013PhaseFromTask($projects);//0;
	$budget->Tahun_2014 = get2014PhaseFromTask($projects);//0;
	$budget->Tahun_2015 = get2015PhaseFromTask($projects);//0;
	$budget->BALANCE = $budget->TOTAL - $budget->Tahun_2010 - $budget->Tahun_2011 - $budget->Tahun_2012 - $budget->Tahun_2013 - $budget->Tahun_2014 - $budget->Tahun_2015;//0;
	
	$dummy_budgets[] = $budget;
	/* end loop 0 */
	
	if($dummy){
		$data = $dummy_budgets;
	} else {
	
	}
	
	// free memory
	pg_free_result($result);
	// close connection
	pg_close($dbconn);
	
	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>