<?php

function getDummy () {
	$dummy_budgets = array();
	/* start loop 0 */
	$budget = new stdClass;
	$budget->BUDGET = 'Budget Version 1';
	$budget->GROUP = "CIBIS Tower 9";
	
		$projects = array();
		/* start loop 1 */
		$project = new stdClass;
		$project->PROJECT = "CIBIS Tower 9";
		
			$phases = array();
			/* start loop 2 */
			$phase = new stdClass;
			$phase->PHASE = "Design Development";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Consept Design";
				$task->TOTAL = 0;
				$task->Thn2010 = 0;
				$task->Thn2011 = 0;
				$task->Thn2012 = 0;
				$task->Thn2013 = 0;
				$task->Thn2014 = 0;
				$task->Thn2015 = 0;
				$task->BALANCE = 0;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = 0;
			$phase->Thn2010 = 0;
			$phase->Thn2011 = 0;
			$phase->Thn2012 = 0;
			$phase->Thn2013 = 0;
			$phase->Thn2014 = 0;
			$phase->Thn2015 = 0;
			$phase->BALANCE = "No Budget Available";
			$phases[] = $phase;
			
			
			$phase = new stdClass;
			$phase->PHASE = "Feasibility Study";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Feasibility Study";
				$task->TOTAL = 0;
				$task->Thn2010 = 0;
				$task->Thn2011 = 0;
				$task->Thn2012 = 0;
				$task->Thn2013 = 0;
				$task->Thn2014 = 0;
				$task->Thn2015 = 0;
				$task->BALANCE = 0;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = 0;
			$phase->Thn2010 = 0;
			$phase->Thn2011 = 0;
			$phase->Thn2012 = 0;
			$phase->Thn2013 = 0;
			$phase->Thn2014 = 0;
			$phase->Thn2015 = 0;
			$phase->BALANCE = "No Budget Available";
			$phases[] = $phase;
			
			
			
			
			$phase = new stdClass;
			$phase->PHASE = "Master Planning";
			
				$tasks = array();
				/* start loop 3 */
				$task = new stdClass;
				$task->TASK = "Concept and Schematic";
				$task->TOTAL = 1726774700;
				$task->Thn2010 = 0;
				$task->Thn2011 = 0;
				$task->Thn2012 = 0;
				$task->Thn2013 = 0;
				$task->Thn2014 = 0;
				$task->Thn2015 = 0;
				$task->BALANCE = 0;
				$tasks[] = $task;
				/* end loop 3 */
				
			$phase->TASKS = $tasks;
			$phase->TOTAL = 1726774700;
			$phase->Thn2010 = 0;
			$phase->Thn2011 = 0;
			$phase->Thn2012 = 0;
			$phase->Thn2013 = 0;
			$phase->Thn2014 = 0;
			$phase->Thn2015 = 0;
			$phase->BALANCE = "No Budget Available";
			$phases[] = $phase;
			/* end loop 2 */
		
		$project->PHASES = $phases;
		$project->TOTAL = 1726774700;
		$project->Thn2010 = 0;
		$project->Thn2011 = 0;
		$project->Thn2012 = 0;
		$project->Thn2013 = 0;
		$project->Thn2014 = 0;
		$project->Thn2015 = 0;
		$project->BALANCE = 0;
		$projects[] = $project;
		/* end loop 1 */
	
	$budget->projects = $projects;
	$budget->TOTAL = 1726774700;
	$budget->Thn2010 = 0;
	$budget->Thn2011 = 0;
	$budget->Thn2012 = 0;
	$budget->Thn2013 = 0;
	$budget->Thn2014 = 0;
	$budget->Thn2015 = 0;
	$budget->BALANCE = 0;
	$budgets[] = $budget;
	/* end loop 1 */
	return $dummy_budgets;
}
?>