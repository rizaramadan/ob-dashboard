<?php

/**
 * File yang berfungsi untuk menyediakan data bagi budget comparison
 *
 * @version    1.0
 */
include "dbcon.php";
include "QueryManager.php";
include "Utils.php";


$result = pg_exec($dbconn, getBudgetBuildingQuery());

$table = "<table border='1' cellpadding='10' cellspacing='0' style='width:100%' class='budgetcost'>"
		. "<thead>"
		. "<tr>"
		. "	<th>NAME</th>"
		. "	<th>BUDGET</th>"
		. "	<th>GROSS FLOOR AREA</th>"
		. "	<th>BUDGET PER GROSS</th>"
		. "	<th>RENT FLOOR AREA</th>"
		. "	<th>BUDGET PER NETT</th>"
		. "</tr>"
		. "</thead>"
		. "<tbody>";

while ($row = pg_fetch_array($result)) {
	$amount = round($row['amount'], 2);
    if($row['gross']<=0 && $row['nett']<=0){
        //$row['gross']=1;
        //$row['nett']=1;
        $totalPerGross = round($amount, 2);
        $totalPerNet = round($amount, 2);
    }else{
        $totalPerGross = round($amount / $row['gross'], 2);
        $totalPerNet = round($amount / intval($row['nett']), 2);
    }

	$table .= "<tr>"
			. "	<td>{$row['budgetname']}</td>"
			. "	<td>{$amount}</td>"
			. "	<td>{$row['gross']}</td>"
			. "	<td>{$totalPerGross}</td>"
			. "	<td>{$row['nett']}</td>"
			. "	<td>{$totalPerNet}</td>"
			. "</tr>";
};

$table .= "</tbody>"
		. "</table>";

echo $table;
exit;

$data = array();

while ($row = pg_fetch_array($result)) {
	if ($row["budgetname"] != '') {
		$data_name1 = $row["budgetname"];

		$amount = new stdClass;
		$amount->v = (int) $row["amount"];
		$amount->f = $row["amount"];

		$gross = new stdClass;
		$gross->v = (int) $row["gross"];
		$gross->f = $row["gross"];

		$nett = new stdClass;
		$nett->v = (int) $row["nett"];
		$nett->f = $row["nett"];

		$data[] = array($data_name1, $amount, $gross, $nett);
	}
}

$table = "";
//print_r($rawData);
$table.= '<table border="1" cellpadding="10" cellspacing="0" style="width:100%" class="budgetcost">';
$table.= '<tr><th>Name</th><th>Budget</th><th>Gross Floor Area</th><th>Rent Floor Area</th></tr>';
$table.='<tr><td>Budget Version 1</td><td>555,910</td><td>92,163</td><td>58,152</td></tr>';
$table.='</table>';

$data = array(array("name" => 'Budget Version 1', 'total' => 555910, 'gross' => 92163, 'nett' => 58152, 'totalPerGross' => round(555910 / 92163, 2), 'totalPerNett' => round(555910 / 58152, 2)));


// free memory
pg_free_result($result);
// close connection
pg_close($dbconn);

echo $_GET['callback'] . '(' . json_encode($data) . ')';
//echo $table;
?>