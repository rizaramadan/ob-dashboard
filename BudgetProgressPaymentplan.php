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
include "dummy.php";
$dummy = false;

header("Content-Type", "application/json");
header("Access-Control-Allow-Origin", "*");


$project_id = getCleanParam($_GET, 'project');
$budget_id = getCleanParam($_GET, 'budget');
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
			and date_part('year',startdate) " . $year . "
			group by c_period.name, startdate
			order by startdate");

while ($row = pg_fetch_array($resultx)) {
	$datax[] = $row["name"];
}

$totalBudget = 0;
if ($dummy) {
	$dataBudget = getDummyBudget($project_id);
} else {
	$dataBudget = getRealBudget($dbconn, $project_id, $budget_id);
}

for ($i = 0; $i < count($dataBudget); ++$i) {
	$totalBudget += $dataBudget[$i];
	$dataBudget[$i] = $totalBudget;
}
for ($i = 0; $i < count($dataBudget); ++$i) {
	$dataBudget[$i] = round($dataBudget[$i] / $totalBudget * 100, 2);
}


/*
  Lanjutan query untuk mengisi value dari projects progress (progress)
 */
$dataprogress = array();
$temp = 0;

if ($dummy) {

	$dataProgress = getDummyProgress($project_id);
} else {
	$dataProgress = getProgressInvoiceBased($dbconn, $project_id);
}
for ($i = 0; $i < count($dataProgress); ++$i) {
	$temp += $dataProgress[$i];
	$dataProgress[$i] = $temp;
}
for ($i = 0; $i < count($dataProgress); ++$i) {
	$dataProgress[$i] = round($dataProgress[$i] / $totalBudget * 100, 2);
}



/*
  Query untuk mengisi value dari projects payments (payment plan)
 */
$temp = 0;

if ($dummy) {
	$dayaPaymentplan = getDummyPaymentPlan($project_id);
} else {
	$dayaPaymentplan = getRealPaymentPlan($dbconn, $project_id);
}
for ($i = 0; $i < count($dayaPaymentplan); ++$i) {
	$temp += $dayaPaymentplan[$i];
	$dayaPaymentplan[$i] = $temp;
}
for ($i = 0; $i < count($dayaPaymentplan); ++$i) {
	$dayaPaymentplan[$i] = round($dayaPaymentplan[$i] / $totalBudget * 100, 2);
}


if (isset($_GET['year']) && $_GET['year'] != "") {
	$mulai = ($_GET['year'] - $firstyear) * 12;
	$data['datax'] = array_slice($datax, $mulai, 12);
	$data['databudget'] = array_slice($dataBudget, $mulai, 12);
	if ($mulai < count($dataProgress)) {
		$data['progress'] = array_slice($dataProgress, $mulai, 12);
	}
	$data['payment_plan'] = array_slice($dayaPaymentplan, $mulai, 12);
} else {
	$data['datax'] = $datax;
	$data['databudget'] = $dataBudget;
	$data['progress'] = $dataProgress;
	$data['payment_plan'] = $dayaPaymentplan;
}

pg_close($dbconn);

//echo $_GET['callback'] . '(' . json_encode($data) . ')';
echo json_encode($data);
?>