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
 	include "dummy.php";
	
	$dummmy = false;

	$project_id = getCleanParam($_GET,'project');
	$budget_id = getCleanParam($_GET,'budget');
	$year = " is not null ";
	$currency = $_GET['currency'];
	//$barCount = ($year == " is not null ") ? $barCount : 11;
	//$penguranganbulan = ($year == " is not null ") ? 0 : 12*($_GET['year']-$firstyear);
	
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
	var_dump(pg_fetch_all($result_budgetplan));exit;


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
		switch ($currency) {
			case 'usd':
				$databudgetplan[$row['bulan']-1]  += (int) $row['amount_usd'];
				$datatotalbudget[$row['bulan']-1]  += (int) $row['amount_usd'];
				break;
			default:
				$databudgetplan[$row['bulan']-1]  += (int) $row['amount'];
				$datatotalbudget[$row['bulan']-1]  += (int) $row['amount'];
				break;
		}
		
	}
	
	if($dummmy) {
		$dummyBudget = getDummyBudget($project_id);
		for($i = 0; $i < count($dummyBudget); ++$i) {
			$databudgetplan[$i] = round($dummyBudget[$i],2);
			$datatotalbudget[$i] = round($dummyBudget[$i],2);
		}
		
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
		  switch ($currency) {
			  case 'usd':
				  $datapaymentPlan[$row['bulan']-1]  = (int) $row['amount_usd'];
				  $datapaymentTotal[$row['bulan']-1]  = (int) $row['amount_usd'];
				  break;
			  default:
				  $datapaymentPlan[$row['bulan']-1]  = (int) $row['amount'];
				  $datapaymentTotal[$row['bulan']-1]  = (int) $row['amount'];
				  break;
		  }
		
	}
	
	if($dummmy) {
		$temp = 0;
		$dummyPaymentplan = getDummyPaymentPlan($project_id);
		for($i = 0; $i < count($dummyPaymentplan); ++$i) {
			$datapaymentPlan[$i]  = round($dummyPaymentplan[$i],2);
			$datapaymentTotal[$i]  = round($dummyPaymentplan[$i],2);
		}
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


	if (isset($_GET['year'])&&$_GET['year']!=""){
		$mulai = ($_GET['year']-$firstyear)*12;
		$data['budgetplan'] = array_slice($databudgetplan,$mulai,12); 
		$data['totalbudget'] = array_slice($datatotalbudget,$mulai,12);  
		$data['paymentplan'] = array_slice($datapaymentPlan,$mulai,12); 
		$data['totalpayment'] = array_slice($datapaymentTotal,$mulai,12); 
		$data['datax'] = array_slice($datax,$mulai,12); 
	} else {
		$data['budgetplan'] = $databudgetplan; 
		$data['totalbudget'] = $datatotalbudget; 
		$data['paymentplan'] = $datapaymentPlan; 
		$data['totalpayment'] = $datapaymentTotal;
		$data['datax'] = $datax;
	}

	// free memory
	pg_free_result($result_budgetplan);
	// close connection
	pg_close($dbconn);
	
	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>