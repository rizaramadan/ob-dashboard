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
	
	$data = array(); 
	while($row = pg_fetch_array($result)) {
		   $data[] = $row;
	}

	// free memory
	pg_free_result($result);
	// close connection
	pg_close($dbconn);
	
	// echo getBudgetVsCostQuery($project_id, $budget_id);
	echo $_GET['callback'] . '(' . json_encode($data) . ')';
    //echo $_GET['callback'] . '<pre>(' . json_encode($data,JSON_PRETTY_PRINT) . ')</pre>';
?>