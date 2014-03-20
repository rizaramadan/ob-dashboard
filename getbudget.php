<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi dropdown budget
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @copyright  Wiradipa 2013 
	 * @version    1.0
	 */
	 
	include "dbcon.php";
	include "Utils.php";
		
	$project_id = getCleanParam($_GET,'project');
	$query = "select * from c_budget where c_budget_id in (select distinct c_budget_id from c_budgetline where c_project_id $project_id)  order by created desc";
	//echo $query; exit;
	$result = pg_exec($dbconn, $query);
	$data = array();
  	while($row = pg_fetch_array($result)) {
  		$data[] = $row;
	}

	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>