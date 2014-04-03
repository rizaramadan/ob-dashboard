<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi dropdown proyek
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @copyright  Wiradipa 2013 
	 * @version    1.0
	 */
	 
	include "dbcon.php";

	$result = pg_exec($dbconn, "select * from c_project order by created desc");
	$data = array();
  	while($row = pg_fetch_array($result)) {
  		$data[] = $row;
	}

	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>
