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
    $budget->id="1";
	$budget->NAME = 'Budget Version 1';
	$budget->GROUP = "";
	
		$projects = array();
		/* start loop 1 */
		$project = new stdClass;
		$project->NAME = "CIBIS9";
        $project->id = "2";

			$phases = array();
			/* start loop 2 */
			$phase = new stdClass;
            $phase->id="21";
			$phase->NAME = "Feasibility Study";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="211";
				$task->NAME = "Appraisal Work";
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
                $task->id="212";
				$task->NAME = "Feasibility Study";
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

			$phase->children = $tasks;
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
            $phase->id="22";
			$phase->NAME = "Master Planning";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="221";
				$task->NAME = "Concept and Schematic";
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

			$phase->children = $tasks;
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
            $phase->id="23";
			$phase->NAME = "Design Development";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="231";
				$task->NAME = "Consept Design";
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
                $task->id="232";
				$task->NAME = "Planning Development Stage";
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
                $task->id="233";
				$task->NAME = "Tender Document Stage";
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
                $task->id="234";
				$task->NAME = "Construction Stage";
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

			$phase->children = $tasks;
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
            $phase->id = 24;
			$phase->NAME = "Infrastructure";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id = 241;
				$task->NAME = "Concept Design";
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
                $task->id = 242;
				$task->NAME = "Planning Development Stage";
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
				$task->NAME = "Tender Document Stage";
                $task->id = 243;
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
                $task->id = 242;
				$task->NAME = "Construction Stage";
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

			$phase->children = $tasks;
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
            $phase->id='25';
			$phase->NAME = "Facade";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id = 251;
				$task->NAME = "Schematic Design Stage";
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
                $task->id = 252;
				$task->NAME = "Design Development Stage";
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
                $task->id = 253;
				$task->NAME = "Tender Document Stage";
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
                $task->id = 254;
				$task->NAME = "Tender Stage";
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
                $task->id = 255;
				$task->NAME = "Performance Mock-Up Stage";
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
                $task->id = 256;
				$task->NAME = "Shop Drawing & Engineering Review Stage";
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
                $task->id = 257;
				$task->NAME = "Fabrication and Installation Stage";
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
                $task->id = 258;
				$task->NAME = "Hand Over Stage";
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

			$phase->children = $tasks;
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
            $phase->id="26";
			$phase->NAME = "Structure and Civil Engineering";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="261";
				$task->NAME = "Concept Design";
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
                $task->id="262";
				$task->NAME = "Planning Development Stage";
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
                $task->id="263";
				$task->NAME = "Tender Document Stage";
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
                $task->id="264";
				$task->NAME = "Construction Stage";
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

			$phase->children = $tasks;
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
            $phase->id = '27';
			$phase->NAME = "Mechanical,  Electrical and Plumbing";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="271";
				$task->NAME = "Design Concept";
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
                $task->id="272";
				$task->NAME = "Design Schematic";
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
                $task->id="273";
				$task->NAME = "Design Development";
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
                $task->id="274";
				$task->NAME = "Detail Design % Document ";
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
                $task->id="275";
				$task->NAME = "Tender Phase";
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
                $task->id="276";
				$task->NAME = "Construction Stage";
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


			$phase->children = $tasks;
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
            $phase->id="28";
			$phase->NAME = "Maket/Model";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id = "281";
				$task->NAME = "Maket/Model";
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

			$phase->children = $tasks;
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
            $phase->id='29';
			$phase->NAME = "Soil Test";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="291";
				$task->NAME = "Factual Investigation";
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
                $task->id="292";
				$task->NAME = "SSRA Study";
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
                $task->id="293";
				$task->NAME = "Geotechnical Design Report";
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
                $task->id="294";
				$task->NAME = "TPKB Permission Approval";
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

			$phase->children = $tasks;
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
            $phase->id = '30';
			$phase->NAME = "Survey-Topography";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="301";
				$task->NAME = "Topography Survey";
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

			$phase->children = $tasks;
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
            $phase->id = '31';
			$phase->NAME = "Quantity Surveyor";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="311";
				$task->NAME = "Project Concept Stage";
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
                $task->id="312";
				$task->NAME = "Documentation Stage";
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
                $task->id="313";
				$task->NAME = "Tender Phase and Contract Award";
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
                $task->id="313";
				$task->NAME = "Monthly Construction Phase";
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
                $task->id="313";
				$task->NAME = "Final Account";
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

			$phase->children = $tasks;
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
            $phase->id = '32';
			$phase->NAME = "Interior";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id='321';
				$task->NAME = "Concept Design";
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
                $task->id='322';
				$task->NAME = "Planning Development Stage";
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
				$task->NAME = "Tender Document Stage";
                $task->id='323';
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
                $task->id='324';
				$task->NAME = "Construction Stage";
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

			$phase->children = $tasks;
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
            $phase->id ='33';
			$phase->NAME = "Special Lighting";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id = '331';
				$task->NAME = "Design Concept";
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
                $task->id = '332';
				$task->NAME = "Design Development";
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
                $task->id = '333';
				$task->NAME = "Tender Documentation";
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
                $task->id = '334';
				$task->NAME = "Construction Administration";
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

			$phase->children = $tasks;
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
            $phase->id = "34";
			$phase->NAME = "Interior";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="341";
				$task->NAME = "Design Concept";
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
                $task->id="342";
				$task->NAME = "Design Development";
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
                $task->id="343";
				$task->NAME = "Tender Documentation";
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
                $task->id="344";
				$task->NAME = "Construction Administration";
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

			$phase->children = $tasks;
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
            $phase->id="35";
			$phase->NAME = "Green Consultant";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id='351';
				$task->NAME = "Schematic Design";
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
                $task->id='352';
				$task->NAME = "Design Development";
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
                $task->id='352';
				$task->NAME = "Tender Documentation";
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
                $task->id='353';
				$task->NAME = "Construction Period";
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
                $task->id='354';
				$task->NAME = "LEED Construction Submission";
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

			$phase->children = $tasks;
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
            $phase->id="36";
			$phase->NAME = "Amdal";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id='361';
				$task->NAME = "Completion document for Andal, RKL and RPL";
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
                $task->id='362';
				$task->NAME = "Completion document legalization for Andal, RKL and RPL";
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

			$phase->children = $tasks;
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
            $phase->id="37";
			$phase->NAME = "Security and Risk";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id='371';
				$task->NAME = "Design Schematic";
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
                $task->id='372';
				$task->NAME = "Tender Documentation";
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
                $task->id='373';
				$task->NAME = "Detail Design Documentation";
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

			$phase->children = $tasks;
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
            $phase->id = '38';
			$phase->NAME = "Utility Connection Fee";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id='381';
				$task->NAME = "PLN Connection Fee";
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
                $task->id='382';
				$task->NAME = "Telkom Connection Fee";
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

			$phase->children = $tasks;
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
            $phase->id="39";
			$phase->NAME = "Dirwas";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id='391';
				$task->NAME = "Dirwas";
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

			$phase->children = $tasks;
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
            $phase->id="40";
			$phase->NAME = "Construction Management";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="401";
				$task->NAME = "Construction Stage";
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
                $task->id="402";
				$task->NAME = "Maintainance Stage";
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

			$phase->children = $tasks;
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
            $phase->id="41";
			$phase->NAME = "Project Management";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="411";
				$task->NAME = "Personel";
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
                $task->id="412";
				$task->NAME = "Operational Overhead";
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

			$phase->children = $tasks;
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
            $phase->id="42";
			$phase->NAME = "Permit and Fee";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="421";
				$task->NAME = "Lulus TPAK";
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
                $task->id="422";
				$task->NAME = "Revisi BLAD";
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
                $task->id="423";
				$task->NAME = "SIPPT";
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
                $task->id="423";
				$task->NAME = "Pelampauan KLB";
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
                $task->id="424";
				$task->NAME = "Test Pile";
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
                $task->id="425";
				$task->NAME = "Blok Plan";
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
                $task->id="426";
				$task->NAME = "IP Struktur";
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
                $task->id="427";
				$task->NAME = "IMB Definitif";
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
                $task->id="428";
				$task->NAME = "Revisi Blaad,  KDB 30 %  dan KLB 3,5";
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
                $task->id="429";
				$task->NAME = "Pemecah Sertipikat";
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
                $task->id="430";
				$task->NAME = "KRK";
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
                $task->id="431";
				$task->NAME = "SLF";
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
                $task->id="432";
				$task->NAME = "KKOP";
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
                $task->id="433";
				$task->NAME = "Biaya Notaris";
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
                $task->id="434";
				$task->NAME = "Izin lain-lain";
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

			$phase->children = $tasks;
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
            $phase->id = '44';
			$phase->NAME = "Retribution Cost";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="441";
				$task->NAME = "IMB";
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
                $task->id="442";
				$task->NAME = "AMDAL";
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
                $task->id="443";
				$task->NAME = "Jalan - PU - Dishub";
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
                $task->id="444";
				$task->NAME = "Pajak Reklame - Construction";
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
                $task->id="445";
				$task->NAME = "NAME/BRANDING/LOGO/COPYRIGHT";
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

			$phase->children = $tasks;
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
            $phase->id="45";
			$phase->NAME = "Traffic Study";

				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="451";
				$task->NAME = "Draft Traffic Study Report";
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
                $task->id="452";
				$task->NAME = "Final Traffic Study Report";
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

			$phase->children = $tasks;
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

		$project->children = $phases;
		$project->TOTAL = getTotalPhaseFromTask($phases);//1726774700;
		$project->Tahun_2010 = get2010PhaseFromTask($phases);//0;
		$project->Tahun_2011 = get2011PhaseFromTask($phases);//0;
		$project->Tahun_2012 = get2012PhaseFromTask($phases);//0;
		$project->Tahun_2013 = get2013PhaseFromTask($phases);//0;
		$project->Tahun_2014 = get2014PhaseFromTask($phases);//0;
		$project->Tahun_2015 = get2015PhaseFromTask($phases);//0;
		$project->BALANCE = $project->TOTAL - $project->Tahun_2010 - $project->Tahun_2011 - $project->Tahun_2012 - $project->Tahun_2013 - $project->Tahun_2014 - $project->Tahun_2015;//0;
		$projects[] = $project;

//endof CIBIS 9 ----------------------------------------------------------------------


        $project = new stdClass;
		$project->NAME = "Estate";
        $project->id="B";
		
			$phases = array();
			/* start loop 2 */

			$phase = new stdClass;
            $phase->id="B1";
			$phase->NAME = "Foundation";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B11";
				$task->NAME = "Bored Piles";
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
				
			$phase->children = $tasks;
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
            $phase->id="B2";
			$phase->NAME = "Bulk Excavation";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B21";
				$task->NAME = "Excavations and Site Clearance";
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
				
			$phase->children = $tasks;
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
            $phase->id="B3";
			$phase->NAME = "Structural Work";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B31";
				$task->NAME = "Backfilling to make up level";
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
                $task->id="B31";
				$task->NAME = "Foundations";
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
                $task->id="B32";
				$task->NAME = "Basement Structure";
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
                $task->id="B33";
				$task->NAME = "Tender Document Stage";
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
                $task->id="B34";
				$task->NAME = "Tower Structure";
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
				
			$phase->children = $tasks;
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
            $phase->id="B4";
			$phase->NAME = "Architectural Works";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B41";
				$task->NAME = "External Wall and Finishes (brick wall, cement render, painting, etc)";
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
                $task->id="B42";
				$task->NAME = "Window and Doors";
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
                $task->id="B43";
				$task->NAME = "Internal Wall and Partitions";
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
                $task->id="B44";
				$task->NAME = "Wall FInishes";
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
                $task->id="B45";
				$task->NAME = "External Walls and Finishing";
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
                $task->id="B46";
				$task->NAME = "Floor Finishes";
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
                $task->id="B47";
				$task->NAME = "Ceiling Finishes";
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
                $task->id="B48";
				$task->NAME = "Sanitary Appliances";
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
				
			$phase->children = $tasks;
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
            $phase->id="B5";
			$phase->NAME = "Facade";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B51";
				$task->NAME = "Façade (Glass, Frame, Sun Shade, ACP)";
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
				
			$phase->children = $tasks;
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
            $phase->id="B6";
			$phase->NAME = "Stone Work";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B61";
				$task->NAME = "Wall Stone Works (Granit and Marble";
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
                $task->id="B62";
				$task->NAME = "Floor Stone Works (Granit and Marble";
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
				
			$phase->children = $tasks;
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
            $phase->id="B7";
			$phase->NAME = "Furniture and Equipment";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B71";
				$task->NAME = "Fittings, Furnitures and Equipment (FF&E).";
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
				
			$phase->children = $tasks;
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
            $phase->id="B8";
			$phase->NAME = "Signage";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B81";
				$task->NAME = "Signage, Graphic,s, and Functon Equipment";
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
				
			$phase->children = $tasks;
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
            $phase->id="B9";
			$phase->NAME = "MEP";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B91";
				$task->NAME = "Plumbing Installations";
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
                $task->id="B92";
				$task->NAME = "Fire Protection and Detection";
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
                $task->id="B93";
				$task->NAME = "Electrical Installation";
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
                $task->id="B94";
				$task->NAME = "Minor Bulding MEP";
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
                $task->id="B95";
				$task->NAME = "External MEP";
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
				
			$phase->children = $tasks;
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
            $phase->id="B10";
			$phase->NAME = "Special Lighting";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B101";
				$task->NAME = "Special Lighting";
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
				
			$phase->children = $tasks;
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
            $phase->id="B11";
			$phase->NAME = "MVAC";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B111";
				$task->NAME = "Air COnditioning and Ventilation";
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
				
			$phase->children = $tasks;
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
            $phase->id="B12";
			$phase->NAME = "Electronic and Secutiry System";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B121";
				$task->NAME = "Communication and Security Installation";
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
                $task->id="B122";
				$task->NAME = "Vertical Transportation Installation";
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
				
			$phase->children = $tasks;
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
            $phase->id="B13";
			$phase->NAME = "Elevator and Escalator";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B131";
				$task->NAME = "Elevator and Escalator";
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
				
			$phase->children = $tasks;
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
            $phase->id="B14";
			$phase->NAME = "Gondola System";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B141";
				$task->NAME = "Gondola";
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
				
			$phase->children = $tasks;
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
            $phase->id="B15";
			$phase->NAME = "Genset Installation";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B151";
				$task->NAME = "Stanby power generator installations (8000 kVA).";
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
				
			$phase->children = $tasks;
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
            $phase->id="B16";
			$phase->NAME = "Utility";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B161";
				$task->NAME = "PLN Electrical Supply";
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
                $task->id="B162";
				$task->NAME = "PDAM Water Supply";
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
                $task->id="B163";
				$task->NAME = "Deep Well Installation";
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
                $task->id="B164";
				$task->NAME = "Water Treatment Plant";
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
                $task->id="B165";
				$task->NAME = "Sewage Treatment Plant";
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
                $task->id="B166";
				$task->NAME = "Drainage Outfall";
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
                $task->id="B167";
				$task->NAME = "TELKOM Telephone Lines";
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
                $task->id="B168";
				$task->NAME = "Builder's work in connection with utilities.";
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
				
			$phase->children = $tasks;
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
            $phase->id="B17";
			$phase->NAME = "Infrastructure";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B171";
				$task->NAME = "Minor Building (F & B and Miscelaneous Minor Building)";
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
                $task->id="B172";
				$task->NAME = "Covered Way";
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
                $task->id="B173";
				$task->NAME = "Hardscaping";
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
                $task->id="B174";
				$task->NAME = "Stormwater drainage";
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
                $task->id="B175";
				$task->NAME = "Elevated Road";
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
				
			$phase->children = $tasks;
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
            $phase->id='B18';
			$phase->NAME = "Landscaping";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id='B181';
				$task->NAME = "Softscaping/Landscaping";
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
				
			$phase->children = $tasks;
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
            $phase->id='B19';
			$phase->NAME = "BWIC and Main Contractors Attendance";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id='B191';
				$task->NAME = "BWIC and Main Contractors Attendance";
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
				
			$phase->children = $tasks;
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
            $phase->id="B20";
			$phase->NAME = "Preliminaries";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B201";
				$task->NAME = "Preliminaries 6%";
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
				
			$phase->children = $tasks;
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
            $phase->id="B21";
			$phase->NAME = "Insurance";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B211";
				$task->NAME = "Insurance 0.1%";
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
				
			$phase->children = $tasks;
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
            $phase->id="B22";
			$phase->NAME = "Contingency";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id='B221';
				$task->NAME = "Contingency";
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
				
			$phase->children = $tasks;
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
            $phase->id="B23";
			$phase->NAME = "PPN";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B231";
				$task->NAME = "PPN 10%";
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
				
			$phase->children = $tasks;
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
            $phase->id="B24";
			$phase->NAME = "Cost of Fund";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
                $task->id="B241";
				$task->NAME = "Bank Interest";
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
                $task->id="B242";
				$task->NAME = "Bank Provision";
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
                $task->id="B243";
				$task->NAME = "Financial Advisor";
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
				
			$phase->children = $tasks;
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
		
		$project->children = $phases;
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
	
	$budget->children = $projects;
	
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
    //echo $_GET['callback'] . '<pre>(' . json_encode($data,JSON_PRETTY_PRINT) . ')</pre>';
?>