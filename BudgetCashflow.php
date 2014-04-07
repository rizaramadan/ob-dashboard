<?php

/**
 * File yang berfungsi untuk menyediakan data bagi graph of budget and cashflow
 *
 * @author     Helmi Agustian <helmi.agustian@wiradipa.com> untuk versi 1.1
 * 
 * @version    2.1
 */
include "dbcon.php";
include "QueryManager.php";
include "Utils.php";
include "dummy.php";

header("Content-Type", "application/json");
header("Access-Control-Allow-Origin", "*");

$dummmy = false;

$project_id = getCleanParam($_GET, 'project');
$budget_id = getCleanParam($_GET, 'budget');
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
			and date_part('year',startdate) " . $year . "
			group by c_period.name, startdate
			order by startdate");


//$budget = $_GET['budget'];
/*
  Query untuk mengisi value dari budget plan
 */


$datax = array();
$pembagi = 1;

while ($row = pg_fetch_array($resultx)) {
	$datax[] = $row["name"];
}

if ($dummmy) {
	$dataBudget = getDummyBudget($budget_id);
} else {
	$dataBudget = getRealBudget($dbconn, $project_id, $budget_id, $currency);
}

for ($i = 0; $i < count($dataBudget); ++$i) {
	$databudgetplan[$i] = round($dataBudget[$i], 2);
	$datatotalbudget[$i] = round($dataBudget[$i], 2);
}

$lastBudgetPlanValue = 0;
for ($i = 0; $i <= $barCount; $i++) {
	if ($datatotalbudget[$i] == 0) {
		$datatotalbudget[$i] = $lastBudgetPlanValue;
	} else {
		$lastBudgetPlanValue += (int) $datatotalbudget[$i];
		$datatotalbudget[$i] = $lastBudgetPlanValue;
	}
}


/*
  Payment plan
 */
$datapaymentPlan = array();
$datapaymentTotal = array();

$temp = 0;
if ($dummmy) {
	$dataPaymentPlan = getDummyPaymentPlan($project_id);
} else {
	$dataPaymentPlan = getRealPaymentPlan($dbconn, $project_id, $currency);
}

for ($i = 0; $i < count($dataPaymentPlan); ++$i) {
	$datapaymentPlan[$i] = round($dataPaymentPlan[$i], 2);
	$datapaymentTotal[$i] = round($dataPaymentPlan[$i], 2);
}


$lastPaymentPlanValue = 0;
for ($i = 0; $i <= $barCount; $i++) {
	if ($datapaymentTotal[$i] == 0) {
		$datapaymentTotal[$i] = $lastPaymentPlanValue;
	} else {
		$lastPaymentPlanValue += (int) $datapaymentTotal[$i];
		$datapaymentTotal[$i] = $lastPaymentPlanValue;
	}
}


if (isset($_GET['year']) && $_GET['year'] != "") {
	$mulai = ($_GET['year'] - $firstyear) * 12;
	$data['budgetplan'] = array_slice($databudgetplan, $mulai, 12);
	$data['totalbudget'] = array_slice($datatotalbudget, $mulai, 12);
	$data['paymentplan'] = array_slice($datapaymentPlan, $mulai, 12);
	$data['totalpayment'] = array_slice($datapaymentTotal, $mulai, 12);
	$data['datax'] = array_slice($datax, $mulai, 12);
} else {
	$data['budgetplan'] = $databudgetplan;
	$data['totalbudget'] = $datatotalbudget;
	$data['paymentplan'] = $datapaymentPlan;
	$data['totalpayment'] = $datapaymentTotal;
	$data['datax'] = $datax;
}

// free memory
// close connection
pg_close($dbconn);

//echo $_GET['callback'] . '(' . json_encode($data) . ')';
echo json_encode($data);
?>