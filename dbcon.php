<?php
	$dbconn = pg_connect("host=localhost dbname=openbravo user=postgres password=helmi") or die('Could not connect: ' . pg_last_error());
?>