<?php

/**
 * Data JSON untuk Grid Perbandingan Budget dengan Area
 */
include "dbcon.php";
include "QueryManager.php";
include "Utils.php";

header("Content-Type:application/json");
$currency = isset($_POST['currency']) ? $_POST['currency'] : "idr";
$result = pg_exec($dbconn, getBudgetBuildingQuery());

$format = function($number) use($currency) {
	if ($currency == 'usd')
		return "$" . number_format($number, 2);
	else
		return "Rp" . number_format($number, 2, ',', '.');
};

$data = array();
$i = 0;
while ($row = pg_fetch_array($result)) {
	$amount = (float) ($currency == 'idr' ? $row['amount'] : $row['amount_usd']);
	$data[$i]['name'] = $row['budgetname'];
	$data[$i]['total'] = $format($total = round($amount, 2));
	$data[$i]['gross'] = $gross = (float) $row['gross'];
	$data[$i]['nett'] = $nett = (float) $row['nett'];
	$data[$i]['totalPerGross'] = $format($totalPerGross = round($total / $gross, 2));
	$data[$i]['totalPerNett'] = $format($totalPerNett = round($total / $nett, 2));
	$i++;
}

// free memory
pg_free_result($result);
// close connection
pg_close($dbconn);

echo json_encode($data);