<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi gantt chart project
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @copyright  Wiradipa 2013 
	 * @version    1.0
	 */
	include "dbcon.php";
	include "Utils.php";
	$project_id = getCleanParam($_GET,'project');
	$year = getCleanParam($_GET,'year');

	$result1 = pg_exec($dbconn, "select c_project_id, name, datecontract, em_pjt_startcontract,  to_char(datecontract,'DD-MM-YYYY') as len,(datecontract::date - em_pjt_startcontract::date) as duration, to_char(em_pjt_startcontract,'DD-MM-YYYY') as custom, em_pjt_progress
			from c_project
			where datecontract is not null and em_pjt_startcontract is not null and c_project_id ".$project_id." order by em_pjt_startcontract
			");
	
	$result21 = pg_exec($dbconn, "select 
						em_pjt_phasegroup_id, c_project_id, pg.name, max(pp.datecontract), min(pp.em_pjt_startcontract),
						to_char(max(pp.datecontract),'DD-MM-YYYY') as len, (max(datecontract)::date - min(em_pjt_startcontract)::date) as duration, 
						to_char(min(em_pjt_startcontract),'DD-MM-YYYY') as custom, avg(em_pjt_progress) as em_pjt_progress
						from pjt_phasegroup pg inner join c_projectphase pp on pg.pjt_phasegroup_id = pp.em_pjt_phasegroup_id
						where datecontract is not null and em_pjt_startcontract is not null and c_project_id ".$project_id."
						group by em_pjt_phasegroup_id ,c_project_id ,pg.name order by max(em_pjt_startcontract)");

	$result2 = pg_exec($dbconn, "select c_projectphase_id, em_pjt_phasegroup_id, c_project_id, name, datecontract, em_pjt_startcontract, to_char(datecontract,'DD-MM-YYYY') as len, (datecontract::date - em_pjt_startcontract::date) as duration, to_char(em_pjt_startcontract,'DD-MM-YYYY') as custom, em_pjt_progress
			from c_projectphase
			where datecontract is not null and em_pjt_startcontract is not null and c_project_id ".$project_id." order by em_pjt_startcontract 
			");

	$result3 = pg_exec($dbconn, "select c_projecttask_id, c_projecttask.c_projectphase_id, c_projecttask.name, c_projecttask.datecontract, c_projecttask.em_pjt_startcontract,  to_char(c_projecttask.datecontract,'DD-MM-YYYY') as len,
		(c_projecttask.datecontract::date - c_projecttask.em_pjt_startcontract::date) as duration, to_char(c_projecttask.em_pjt_startcontract,'DD-MM-YYYY') as custom, c_projecttask.em_pjt_progress
			from c_projecttask inner join c_projectphase on c_projecttask.c_projectphase_id = c_projectphase.c_projectphase_id
			where c_projecttask.datecontract is not null and c_projecttask.em_pjt_startcontract is not null  and c_project_id ".$project_id." order by c_projecttask.	em_pjt_startcontract
			");

	$data = array();
	$datalink = array();
	while($row = pg_fetch_array($result1)) {
		$em_pjt_progress = $row['em_pjt_progress']/100;
		$data[] = (object)array("id"=>$row['c_project_id'], "text"=>$row['name'], "start_date"=>$row['custom'], "end_date"=>$row['len'], "duration"=> $row['duration'], "progress"=> $em_pjt_progress, "open"=> true);

		/* datalink */
		$linkphase = pg_exec($dbconn, "select c_projectphase_id
				from c_projectphase
				where datecontract is not null and em_pjt_startcontract is not null and c_project_id = '".$row['c_project_id']."'");
				
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
	
	while($row = pg_fetch_array($result21)) {
		$em_pjt_progress = $row['em_pjt_progress']/100;
		$data[] = (object)array("id"=>$row['em_pjt_phasegroup_id'], "text"=>$row['name'], "start_date"=>$row['custom'], "end_date"=>$row['len'],"duration"=> $row['duration'], "parent"=>$row['c_project_id'], "progress"=> $em_pjt_progress, "open"=> true);
	}

	while($row = pg_fetch_array($result2)) {
		$em_pjt_progress = $row['em_pjt_progress']/100;
		$data[] = (object)array("id"=>$row['c_projectphase_id'], "text"=>$row['name'], "start_date"=>$row['custom'], "end_date"=>$row['len'],"duration"=> $row['duration'], "parent"=>$row['em_pjt_phasegroup_id'], "progress"=> $em_pjt_progress, "open"=> true);
	}

	while($row = pg_fetch_array($result3)) {
		$em_pjt_progress = $row['em_pjt_progress']/100;
		$data[] = (object)array("id"=>$row['c_projecttask_id'], "text"=>$row['name'], "start_date"=>$row['custom'], "end_date"=>$row['len'],"duration"=> $row['duration'], "parent"=>$row['c_projectphase_id'], "progress"=> $em_pjt_progress, "open"=> true);
	}

	$obj = new stdClass;
	$obj->data = $data;
	$obj->links = $datalink;

	echo $_GET['callback'] . '(' . json_encode($obj) . ')';
?>