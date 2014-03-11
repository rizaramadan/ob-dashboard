<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi graph of budget, progress and payment 
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @copyright  Wiradipa 2013 
	 * @version    1.1
	 */
 
 	include "dbcon.php";
 	include "QueryManager.php";
 	include "Utils.php";


	$project_id = getCleanParam($_GET,'project');
	$budget_id = getCleanParam($_GET,'budget');
	$year = " is not null ";
	//$barCount = ($year == " is not null ") ? $barCount : 11;
	//$penguranganbulan = ($year == " is not null ") ? 0 : 12*($_GET['year']-$firstyear);
	$realtotalbudget = 500000000;
	
	/*
		Query untuk mengisi value dari x-Axis
	*/
	$resultx = pg_exec($dbconn, "select c_period.name, startdate
			from c_period
			left join c_budgetline
			on c_budgetline.c_period_id = c_period.c_period_id
			where c_period.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C'
			and date_part('year',startdate) ".$year."
			group by c_period.name, startdate
			order by startdate");
		
		$queryFetchValueFromBudget = getBudgetQuery($project_id,$budget_id,$year);
		
		$result = pg_exec($dbconn,$queryFetchValueFromBudget);
		
		$resultprogress = pg_exec($dbconn, getProjectProgressQuery($project_id,$year));

		$resultpayment = pg_exec($dbconn, getPaymentPlan($project_id,$year));
	


	$numrows = pg_numrows($result);

	$data = array();
	$databudget = array();
	$datax = array();

	for($i = 0;$i<=$barCount;$i++){
		$databudget[$i] = 0;
	}


	while($row = pg_fetch_array($resultx)) {
		$datax[] = $row["name"];
	}

	/*
		Lanjutan query untuk mengisi value dari budget
	*/
	$total = 0;
	$i = 0;
	$rowbefore =null;

	if (true || $budget_id != "" && $project_id != "") {
	  	while($row = pg_fetch_array($result)) {
	  		if ($rowbefore !=null && $rowbefore["c_budgetline_id"] == $row["c_budgetline_id"]) {
				if($budget_id == $row["budget_id"]) {
				   $total += $row["amount"];
				   $databudget[$i-1] = (float)$total;
				}
			}
			else {
			   //if(isset($_GET['budget']) &&  $_GET['budget'] == $row["budget_id"]) {
				   $total += $row["amount"];
				//}

				$databudget[(int)$row['bulan']-1] = (float)$total;
			   $rowbefore = $row;
			   $i = $i+1;
			}
		}
	}
	else {
		while($row = pg_fetch_array($result)) {
			if ($rowbefore["name"] != $row["name"]) {
				$total += $row["amount"];
			   $databudget[(int)$row['bulan']-1] = (float)$total;

			   $rowbefore = $row;
			}
		}
	}
	
	if($total == 0) $total = 1;
	for($i = 0; $i <= $barCount; ++$i) {
		$databudget[$i] = ($databudget[$i]/$realtotalbudget)*100;
	}

	
	for($i = 0;$i<=$barCount;$i++){
		$databudget[$i] = round($databudget[$i], 2);
		if($i > 0 && $databudget[$i] < $databudget[$i-1]){
			$databudget[$i] = $databudget[$i-1];
		}
	}
	

	/*
		Lanjutan query untuk mengisi value dari projects progress (progress)
	*/
	$dataprogress = array();
	
	for($i = 0;$i<=$barCount;$i++){
		$dataprogress[$i] = 0;
	}
	
	while($row = pg_fetch_array($resultprogress)) {
		$dataprogress[$row['bulan']-1]  += (int) $row['amount'];
	}
	//print_r($dataprogress);
	$lastProgressValue = 0;
	for($i = 0;$i<=$barCount;$i++) {
		$lastProgressValue += $dataprogress[$i];
		$dataprogress[$i] = $lastProgressValue;
		/*if($dataprogress[$i] == 0) {
			$dataprogress[$i] = (int)$lastProgressValue;
		} else {
			$lastProgressValue += (int)$dataprogress[$i];
		}*/
	}
	

	/*
		Query untuk mengisi value dari projects payments (payment plan)
	*/
	$datapayment = array();
	for($i = 0;$i<=$barCount;$i++){
		$datapayment[$i] = 0;
	}
	
	$totalValue = $realtotalbudget;
	while($row = pg_fetch_array($resultpayment)) {
		$datapayment[$row['bulan']-1] =  $row['amount'];
	}
	
	$lastTotal = 0;
	for($i = 0;$i<=$barCount;$i++){
		if($datapayment[$i] == 0) {
			$datapayment[$i] = $lastTotal;
		} else {
			$lastTotal += (int)$datapayment[$i];
			$datapayment[$i] = $lastTotal;
		}
	}
	if($totalValue == 0) {$totalValue = 1;}
	//if($totalValue < $total) {$totalValue = $total;}
	for($i = 0;$i<=$barCount;$i++){
		$datapayment[$i] = $datapayment[$i] / $realtotalbudget * 100;
	}
	
	if (isset($_GET['year'])&&$_GET['year']!=""){
		$mulai = ($_GET['year']-$firstyear)*12;
		$data['datax'] = array_slice($datax,$mulai,12);
		$data['databudget'] = array_slice($databudget,$mulai,12);
		$data['progress'] = array_slice($dataprogress,$mulai,12); 
		$data['payment_plan'] = array_slice($datapayment,$mulai,12);
	} else {
		$data['datax'] = $datax;
		$data['databudget'] = $databudget;
		// $data['databudget'] = round((float)$databudget, 2);
		$data['progress'] = $dataprogress; 
		$data['payment_plan'] = $datapayment;
	}
	
	

	pg_free_result($result);
	pg_free_result($resultprogress);
	pg_close($dbconn);
	
	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>