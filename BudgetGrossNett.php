<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi budget comparison
	 *
	 * @version    1.0
	 */

	include "dbcon.php";	
	include "QueryManager.php";
 	include "Utils.php";

	$result = pg_exec($dbconn,  getBudgetBuildingQuery());

	$data = array(); 

    while($row = pg_fetch_array($result)) {
    	if($row["budgetname"] != '') {
	       	$data_name1 = $row["budgetname"]; 
		   
		   	$amount = new stdClass;
		   	$amount->v = (int)$row["amount"];
		   	$amount->f = $row["amount"];

			$gross = new stdClass;
		   	$gross->v = (int)$row["gross"];
		   	$gross->f = $row["gross"];

			$nett = new stdClass;
			$nett->v = (int)$row["nett"];
		   	$nett->f = $row["nett"];

		   $data[] = array($data_name1,$amount,$gross,$nett);
		}
	}

	// free memory
	pg_free_result($result);
	// close connection
	pg_close($dbconn);

	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>