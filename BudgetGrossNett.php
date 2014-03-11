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
	
	$table = "";
	//print_r($rawData);
	$table.= '<table border="1" cellpadding="10" cellspacing="0" style="width:100%" class="budgetcost">';
	$table.= '<tr><th>Name</th><th>Budget</th><th>Gross Floor Area</th><th>Rent Floor Area</th></tr>';
	$table.='<tr><td>Budget Version 1</td><td>555,910</td><td>92,163</td><td>58,152</td></tr>';
	$table.='</table>';
	
	

	// free memory
	pg_free_result($result);
	// close connection
	pg_close($dbconn);

	//echo $_GET['callback'] . '(' . json_encode($data) . ')';
	echo $table;
?>