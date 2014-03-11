<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi dropdown year
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @copyright  Wiradipa 2013 
	 * @version    1.0
	 */
	 
	include "dbcon.php";

	$result = pg_exec($dbconn, "select date_part('year',startdate) as year
			from c_period
			left join c_budgetline
			on c_budgetline.c_period_id = c_period.c_period_id
			where c_period.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C'
			group by date_part('year',startdate)
			order by date_part('year',startdate)");
	$data = array();
  	while($row = pg_fetch_array($result)) {
  		$data[] = $row;
	}

	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>
