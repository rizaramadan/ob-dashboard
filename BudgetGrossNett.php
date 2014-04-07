<?php

/**
 * Data JSON untuk Grid Perbandingan Budget dengan Area
 */
include "dbcon.php";
include "QueryManager.php";
include "Utils.php";

header("Content-Type", "application/json");
header("Access-Control-Allow-Origin", "*");

$currency = isset($_POST['currency']) ? $_POST['currency'] : "idr";

$result = pg_exec($dbconn, getBudgetBuildingQuery($currency));
$data = pg_fetch_all($result);

// free memory
pg_free_result($result);

// close connection
pg_close($dbconn);

echo json_encode($data);
