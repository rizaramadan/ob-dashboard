<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi graph of budget, progress and payment 
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @copyright  Wiradipa 2013 
	 * @version    1.1
	 */
 
 	include "dbcon.php";
	$barCount = 35;
	$firstyear = 2013;

	$project_id = " is not null ";
	$budget_id = " is not null ";
	if(!isset($_GET['project'])||($_GET['project'] == '')&&($_GET['budget'] == '')){
		$project_id = " is not null ";
		$budget_id = " is not null ";
	 
	} else if (($_GET['project'] != '')&&($_GET['budget'] == '')) {
		$project_id = " = '".$_GET['project']."'";
		$budget_id = " is not null ";
	 
	 } else if (($_GET['project'] == '')&&($_GET['budget'] != '')) { 
		$project_id = " is not null ";
		$budget_id = " = '".$_GET['budget']."'";
	 
	 } else if (($_GET['project'] != '')&&($_GET['budget'] != '')) {
		$project_id = " = '".$_GET['project']."'";
		$budget_id = " = '".$_GET['budget']."'";
	 	  
	 }
	
	

	/*
		Query untuk mengisi value dari x-Axis
	*/
	$resultx = pg_exec($dbconn, "select c_period.name, startdate
			from c_period
			join c_budget
			on c_budget.c_year_id = c_period.c_year_id
			where true
			group by c_period.name, startdate
			order by startdate");
	
		/*
			Query untuk mengisi value dari budget
		*/
		$queryFetchValueFromBudget = "select c_budgetline.amount as amount, c_period.startdate, c_period.name, c_budgetline.c_budget_id as budget_id, (date_part('year',c_period.startdate) - ".$firstyear.") * 12 + date_part('month',c_period.startdate) as bulan
			from c_period
			left outer join c_budgetline on c_budgetline.c_period_id = c_period.c_period_id
			left outer join m_product
			on m_product.m_product_id = c_budgetline.m_product_id 
			left outer join c_projectphase
			on m_product.m_product_id = c_projectphase.m_product_id
			
			where
			c_budgetline.c_currency_id = '303' and c_projectphase.c_project_id ".$project_id."  and c_budgetline.c_budget_id ".$budget_id." 
			order by startdate";
		/*$result = pg_exec($dbconn, "select c_budgetline.amount as amount, c_period.startdate, c_period.name, c_budgetline.c_budget_id as budget_id, to_char(c_period.startdate, 'MM') as bulan
			from c_period
			left outer join c_budgetline
			on c_budgetline.c_period_id = c_period.c_period_id
			left outer join m_product
			on m_product.m_product_id = c_budgetline.m_product_id 
			left outer join c_projectphase
			on m_product.m_product_id = c_projectphase.m_product_id
			where to_char(c_period.startdate, 'YYYY') in (
					select to_char(c_period.startdate, 'YYYY') as custom_year
					from c_period
					join c_budgetline
					on c_budgetline.c_period_id = c_period.c_period_id
					group by c_period.name, startdate
					order by startdate
					limit 1
				) and
			c_budgetline.c_currency_id = '303' and c_projectphase.c_project_id = '$project_id'  and c_budgetline.c_budget_id = '$budget_id'
			order by startdate");*/
		$result = pg_exec($dbconn,$queryFetchValueFromBudget);
		
		/*
			Query untuk mengisi value dari projects progress (progress)
		*/
		$resultprogress = pg_exec($dbconn, "select pss_progresshistory.pss_progresshistory_id,
			pss_progresshistory.progress_project as amount, 
			(date_part('year',pss_progresshistory.created) - ".$firstyear.") * 12 + date_part('month',pss_progresshistory.created) as bulan,
			to_char(pss_progresshistory.created, 'dd') as tanggal,
			c_projectphase.c_project_id as project_id
			from pss_progresshistory
			join c_projectphase
			on pss_progresshistory.c_projectphase_id = c_projectphase.c_projectphase_id
			where c_projectphase.c_project_id ".$project_id."
			order by pss_progresshistory.created");

		/*
			Query untuk mengisi value dari projects payments (payment plan)
		*/
		$resultpayment = pg_exec($dbconn, "select sum(finacc_txn_amount) as amount, (date_part('year',paymentdate) - 2011) * 12 + date_part('month',paymentdate) as bulan from fin_payment
			where fin_payment.c_project_id ".$project_id."
				and fin_payment.isreceipt = 'N'
			and true
			group by bulan
			order by bulan");
	


	$numrows = pg_numrows($result);

	$data = array();
	$databudget = array();
	$datax = array();

	for($i = 0;$i<=$barCount;$i++){
		$databudget[$i] = 0;
	}


	while($row = pg_fetch_array($resultx)) {
		$datax[] = $row["name"];
	}

	/*
		Lanjutan query untuk mengisi value dari budget
	*/
	$total = 0;
	$i = 0;
	$rowbefore =null;

	if (true || $_GET['budget'] != "" && $_GET['project'] != "") {
	  	while($row = pg_fetch_array($result)) {
	  		if ($rowbefore !=null && $rowbefore["name"] == $row["name"]) {
				if($_GET['budget'] == $row["budget_id"]) {
				   $total += $row["amount"];
				   $databudget[$i-1] = (float)$total;
				}
			}
			else {
			   //if(isset($_GET['budget']) &&  $_GET['budget'] == $row["budget_id"]) {
				   $total += $row["amount"];
				//}

				$databudget[(int)$row['bulan']-1] = (float)$total;
			   $rowbefore = $row;
			   $i = $i+1;
			}
		}
	}
	else {
		while($row = pg_fetch_array($result)) {
			if ($rowbefore["name"] != $row["name"]) {
				$total += $row["amount"];
			   $databudget[(int)$row['bulan']-1] = (float)$total;

			   $rowbefore = $row;
			}
		}
	}
	if($total == 0) $total = 1;
	for($i = 0; $i < $barCount; ++$i) {
		$databudget[$i] = ($databudget[$i]/$total)*100;
	}

	for($i = 0;$i<=$barCount;$i++){
		$databudget[$i] = round($databudget[$i], 2);
		if($i > 0 && $databudget[$i] < $databudget[$i-1]){
			$databudget[$i] = $databudget[$i-1];
		}
	}

	/*
		Lanjutan query untuk mengisi value dari projects progress (progress)
	*/
	$dataprogress = array();
	$dataprogresses = array();
	$lastProgressValue = 0;
	for($i = 0;$i<=$barCount;$i++){
		$dataprogress[$i] = 0;
	}
	if(true || isset($_GET['project']) && $_GET['project'] != ""){
		while($row = pg_fetch_array($resultprogress)) {
			$lastProgressValue +=(int)$row["amount"];
			$dataprogress[(int)$row['bulan']-1] = $lastProgressValue;
		}


		for($i = 0;$i<=$barCount;$i++){
			if($i > 0 && $dataprogress[$i] < $dataprogress[$i-1]){
				$dataprogress[$i] = $dataprogress[$i-1];
			}
		}

		if($lastProgressValue == 0) $lastProgressValue = 1;
		for($i = 0;$i<=$barCount;$i++){
			$dataprogress[$i] = $dataprogress[$i]/$lastProgressValue*100;
		}
	} else {
		for($m=0;$m<count($resultprogresses);$m++){
			$data_progress = array();
			for($s = 0;$s<=$barCount;$s++){
				$data_progress[$s] = 0;
			}
			while($row = pg_fetch_array($resultprogresses[$m])) {
				$data_progress[(int)$row['bulan']-1] = (int)$row["amount"];
			}

			for($i = 0;$i<=$barCount;$i++){
				if($data_progress[$i] < $data_progress[$i-1]){
					$data_progress[$i] = $data_progress[$i-1];
				}
			}
			$dataprogresses[$m] = $data_progress;
		}
		for($i = 0;$i<=$barCount;$i++){
			$total_projectprogress=0;
			for($j=0;$j<count($dataprogresses);$j++){
				$total_projectprogress=$total_projectprogress+$dataprogresses[$j][$i];
			}
			$dataprogress[$i]=$total_projectprogress/count($dataprogresses);
		}
	}

	/*
		Query untuk mengisi value dari projects payments (payment plan)
	*/
	$datapayment = array();
	$datapayments = array();
	$total_payments = array();
	for($i = 0;$i<=$barCount;$i++){
		$datapayment[$i] = 0;
	}
	if(true || isset($_GET['project']) && $_GET['project'] != ""){
		$total = 0;
		while($row = pg_fetch_array($resultpayment)) {
			$total += $row['amount'];
			$datapayment[(int)$row['bulan']-1] = (int)$total;
		}

		for($i = 0;$i<=$barCount;$i++){
			if($i > 0 && $datapayment[$i] < $datapayment[$i-1]){
				$datapayment[$i] = $datapayment[$i-1];
			}
		}
		if($total == 0) $total = 1;
		for($i = 0;$i<=$barCount;$i++){
			$datapayment[$i] = $datapayment[$i]/$total*100;
		}
	} else {
		for($m=0;$m<count($resultpayments);$m++){
			$data_payment = array();
			for($s = 0;$s<=$barCount;$s++){
				$data_payment[$s] = 0;
			}
			$total = 0;
			while($row = pg_fetch_array($resultpayments[$m])) {
				$total += $row['amount'];
				$data_payment[(int)$row['bulan']-1] = (int)$total;
			}

			for($i = 0;$i<=$barCount;$i++){
				if($data_payment[$i] < $data_payment[$i-1]){
					$data_payment[$i] = $data_payment[$i-1];
				}
			}

			for($i = 0;$i<=$barCount;$i++){
				$data_payment[$i] = $data_payment[$i]/$total*100;
			}

			$datapayments[$m] = $data_payment;
		}
		for($i = 0;$i<=$barCount;$i++){
			$total_projectpayment=0;
			for($j=0;$j<count($datapayments);$j++){
				$total_projectpayment=$total_projectpayment+$datapayments[$j][$i];
			}
			$datapayment[$i]=$total_projectpayment/count($resultpayments);
		}
	}

	$data['datax'] = $datax;
	$data['databudget'] = $databudget;
	// $data['databudget'] = round((float)$databudget, 2);
	$data['progress'] = $dataprogress; 
	$data['payment_plan'] = $datapayment;

	pg_free_result($result);
	pg_free_result($resultprogress);
	pg_close($dbconn);
	
	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>