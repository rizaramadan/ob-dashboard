<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi graph of budget and cashflow
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @version    1.1
	 */
	 
	include "dbcon.php";
	include "QueryManager.php";
 	include "Utils.php";

	$project_id = getCleanParam($_GET,'project');
	$budget_id = getCleanParam($_GET,'budget');
	$year = getCleanParam($_GET,'year');
	$barCount = ($year == " is not null ") ? $barCount : 11;
	$penguranganbulan = ($year == " is not null ") ? 0 : 12*($_GET['year']-$firstyear);
	
	//$budget_id = $_GET['budget'];


	$resultx = pg_exec($dbconn, "select c_period.name, startdate
			from c_period
			left join c_budgetline
			on c_budgetline.c_period_id = c_period.c_period_id
			where c_period.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C'
			and date_part('year',startdate) ".$year."
			group by c_period.name, startdate
			order by startdate");
	
	
		//$budget = $_GET['budget'];
		/*
			Query untuk mengisi value dari budget plan
		*/
	$result_budgetplan = pg_exec($dbconn, getBudgetQuery($project_id, $budget_id, $year));


	$result_paymentplan = pg_exec($dbconn, getPaymentPlan($project_id, $year));


	$data = array();
	$databudgetplan = array();
	$datatotalbudget = array();
	$datax = array();
	$pembagi = 1;

	while($row = pg_fetch_array($resultx)) {
		$datax[] = $row["name"];
	}

	for($i = 0;$i<=$barCount;$i++){
		$databudgetplan[$i] = 0;
		$datatotalbudget[$i] = 0;
	}

	while($row = pg_fetch_array($result_budgetplan)) {
		$databudgetplan[$row['bulan']-1-$penguranganbulan]  += (int) $row['amount'];
		$datatotalbudget[$row['bulan']-1-$penguranganbulan]  += (int) $row['amount'];
	}
	$lastBudgetPlanValue = 0;
	for($i = 0;$i<=$barCount;$i++){
		if($datatotalbudget[$i] == 0) {
			$datatotalbudget[$i] = $lastBudgetPlanValue;
		} else {
			$lastBudgetPlanValue += (int)$datatotalbudget[$i];
			$datatotalbudget[$i] = $lastBudgetPlanValue;
		}
	}
	

	/*
		Payment plan
	*/
	$datapaymentPlan = array();
	$datapaymentTotal = array();
	for($i = 0;$i<=$barCount;$i++){
		$datapaymentPlan[$i] = 0;
		$datapaymentTotal[$i] = 0;
	}
	$rowbefore;
  	while($row = pg_fetch_array($result_paymentplan)) {
  		$datapaymentPlan[$row['bulan']-1-$penguranganbulan]  = (int) $row['amount'];
		$datapaymentTotal[$row['bulan']-1-$penguranganbulan]  = (int) $row['amount'];
	}
	$lastPaymentPlanValue = 0;
	for($i = 0;$i<=$barCount;$i++){
		if($datapaymentTotal[$i] == 0) {
			$datapaymentTotal[$i] = $lastPaymentPlanValue;
		} else {
			$lastPaymentPlanValue += (int)$datapaymentTotal[$i];
			$datapaymentTotal[$i] = $lastPaymentPlanValue;
		}
	}



	$data['budgetplan'] = $databudgetplan; 
	$data['totalbudget'] = $datatotalbudget; 
	$data['paymentplan'] = $datapaymentPlan; 
	$data['totalpayment'] = $datapaymentTotal;
	$data['datax'] = $datax;

	// free memory
	pg_free_result($result_budgetplan);
	// close connection
	pg_close($dbconn);
	
	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>