<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi gantt chart project
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @copyright  Wiradipa 2013 
	 * @version    1.0
	 */

	include "dbcon.php";

	$result1 = pg_exec($dbconn, "select c_project_id, name, datecontract, em_pss_startcontract, (datecontract-em_pss_startcontract) as len, to_char(em_pss_startcontract,'DD-MM-YYYY') as custom 
			from c_project
			where datecontract is not null and em_pss_startcontract is not null
			");

	$result2 = pg_exec($dbconn, "select c_projectphase_id, c_project_id, name, datecontract, em_pss_startcontract, (datecontract-em_pss_startcontract) as len, to_char(em_pss_startcontract,'DD-MM-YYYY') as custom
			from c_projectphase
			where datecontract is not null and em_pss_startcontract is not null
			");

	$result3 = pg_exec($dbconn, "select c_projecttask_id, c_projectphase_id, name, datecontract, em_pss_startcontract, (datecontract-em_pss_startcontract) as len, to_char(em_pss_startcontract,'DD-MM-YYYY') as custom
			from c_projectphase
			where datecontract is not null and em_pss_startcontract is not null
			");

	$data = array();
	while($row = pg_fetch_array($result1)) {
		$data[] = (object)array("id"=>$row['c_project_id'], "text"=>$row['name'], "start_date"=>$row['custom'], "duration"=>substr($row['len'], 0, -5), "progress"=> 0.4, "open"=> true);
	}

	while($row = pg_fetch_array($result2)) {
		$data[] = (object)array("id"=>$row['c_projectphase_id'], "text"=>$row['name'], "start_date"=>$row['custom'], "duration"=>substr($row['len'], 0, -5), "parent"=>$row['c_project_id'], "progress"=> 0.4, "open"=> true);
	}

	while($row = pg_fetch_array($result3)) {
		$data[] = (object)array("id"=>$row['c_projecttask_id'], "text"=>$row['name'], "start_date"=>$row['custom'], "duration"=>substr($row['len'], 0, -5), "parent"=>$row['c_projectphase_id'], "progress"=> 0.4, "open"=> true);
	}

	$obj = new stdClass;
	$obj->data = $data;
	// $obj->links = $links;

	echo $_GET['callback'] . '(' . json_encode($obj) . ')';
?>