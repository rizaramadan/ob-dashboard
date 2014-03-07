<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi gantt chart project
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @copyright  Wiradipa 2013 
	 * @version    1.0
	 */
	include "dbcon.php";

	if (isset($_GET['project_id'])&&$_GET['project_id']!="") {
		$project_id = " = '".$_GET['project_id']."'";
	} else {
		$project_id = " is not null ";
	}

	$result1 = pg_exec($dbconn, "select c_project_id, name, datecontract, em_pss_startcontract, (datecontract-em_pss_startcontract) as len, to_char(em_pss_startcontract,'DD-MM-YYYY') as custom, em_pss_progress
			from c_project
			where datecontract is not null and em_pss_startcontract is not null and c_project_id ".$project_id."
			");

	$result2 = pg_exec($dbconn, "select c_projectphase_id, c_project_id, name, datecontract, em_pss_startcontract, (datecontract-em_pss_startcontract) as len, to_char(em_pss_startcontract,'DD-MM-YYYY') as custom, em_pss_progress
			from c_projectphase
			where datecontract is not null and em_pss_startcontract is not null
			");

	$result3 = pg_exec($dbconn, "select c_projecttask_id, c_projectphase_id, name, datecontract, em_pss_startcontract, (datecontract-em_pss_startcontract) as len, to_char(em_pss_startcontract,'DD-MM-YYYY') as custom, em_pss_progress
			from c_projecttask
			where datecontract is not null and em_pss_startcontract is not null
			");

	$data = array();
	$datalink = array();
	while($row = pg_fetch_array($result1)) {
		$em_pss_progress = $row['em_pss_progress']/100;
		$data[] = (object)array("id"=>$row['c_project_id'], "text"=>$row['name'], "start_date"=>$row['custom'], "duration"=>substr($row['len'], 0, -5), "progress"=> $em_pss_progress, "open"=> true);

		/* datalink */
		$linkphase = pg_exec($dbconn, "select c_projectphase_id
				from c_projectphase
				where datecontract is not null and em_pss_startcontract is not null and c_project_id = '".$row['c_project_id']."'");
				
		$lastphase = 0;
		$count = 0;
		while($rowlastphase = pg_fetch_array($linkphase)) {
			if ($count > 0){
				$datalink[] = (object)array("id"=>$rowlastphase['c_projectphase_id'], "source"=>$lastphase , "target"=>$rowlastphase['c_projectphase_id'], "type"=> 0);
			}
			$count++;
			$lastphase = $rowlastphase['c_projectphase_id'];
		}
		/* datalink */


	}

	while($row = pg_fetch_array($result2)) {
		$em_pss_progress = $row['em_pss_progress']/100;
		$data[] = (object)array("id"=>$row['c_projectphase_id'], "text"=>$row['name'], "start_date"=>$row['custom'], "duration"=>substr($row['len'], 0, -5), "parent"=>$row['c_project_id'], "progress"=> $em_pss_progress, "open"=> true);
	}

	while($row = pg_fetch_array($result3)) {
		$em_pss_progress = $row['em_pss_progress']/100;
		$data[] = (object)array("id"=>$row['c_projecttask_id'], "text"=>$row['name'], "start_date"=>$row['custom'], "duration"=>substr($row['len'], 0, -5), "parent"=>$row['c_projectphase_id'], "progress"=> $em_pss_progress, "open"=> true);
	}

	$obj = new stdClass;
	$obj->data = $data;
	$obj->links = $datalink;

	echo $_GET['callback'] . '(' . json_encode($obj) . ')';
?>