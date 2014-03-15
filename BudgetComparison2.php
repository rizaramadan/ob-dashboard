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

	
	$budget1_id = getCleanParam($_GET,'budget1');
	$budget2_id = getCleanParam($_GET,'budget2');
	$project_id = getCleanParam($_GET,'project');

	
	$result = pg_exec($dbconn, getBudgetComparison($budget1_id, $budget2_id, $project_id));
  	$numrows = pg_numrows($result);

	$data = array(); 
	while($row = pg_fetch_array($result)) {
		   $data[] = $row;
	}
	
	// free memory
	pg_free_result($result);
	// close connection
	pg_close($dbconn);
	//
	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>