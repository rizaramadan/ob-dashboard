<?php
	$dbconn = pg_connect("host=localhost dbname=openbravo user=tad password=tad") or die('Could not connect: ' . pg_last_error());
	
?>