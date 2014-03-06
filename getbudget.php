<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi dropdown budget
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @copyright  Wiradipa 2013 
	 * @version    1.0
	 */
	 
	$dbconn = pg_connect("host=localhost dbname=openbravo user=postgres password=postgres") or die('Could not connect: ' . pg_last_error());

	$result = pg_exec($dbconn, "select * from c_budget order by created desc");
	$data = array();
  	while($row = pg_fetch_array($result)) {
  		$data[] = $row;
	}

	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>