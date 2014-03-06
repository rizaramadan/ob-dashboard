<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi graph of budget, progress and payment 
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @copyright  Wiradipa 2013 
	 * @version    1.1
	 */
 
 	include "dbcon.php";
	
	$project_id = $_GET['project'];
	$budget_id = $_GET['budget'];

	/*
		Query untuk mengisi value dari x-Axis
	*/
	$resultx = pg_exec($dbconn, "select c_period.name, startdate
			from c_period
			join c_budgetline
			on c_budgetline.c_period_id = c_period.c_period_id
			where to_char(startdate, 'YYYY') in (
					select to_char(c_period.startdate, 'YYYY') as custom_year
					from c_period
					join c_budgetline
					on c_budgetline.c_period_id = c_period.c_period_id
					group by c_period.name, startdate
					order by startdate
					limit 1
				)
			group by c_period.name, startdate
			order by startdate");

	if(!isset($_GET['project'])||($_GET['project'] == '')&&($_GET['budget'] == '')){
		/*
			Query untuk mengisi value dari budget
		*/
		/*
			c_currency_id = 303 
			berarti IDR
		*/
		/* projecttask */
		$result = pg_exec($dbconn, "select c_budgetline.amount as amount, c_period.startdate, c_period.name, c_budgetline.c_budget_id as budget_id, to_char(c_period.startdate, 'MM') as bulan
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
				) and c_budgetline.c_currency_id = '303'
			order by startdate");

			$resultprojects = pg_exec($dbconn, "select * from c_project");

			$resultprogresses = array();
			$resultpayments = array();

			$z = 0;
			while($row = pg_fetch_array($resultprojects)) {
				$projectid = $row['c_project_id'];
				/*
					Query untuk mengisi value dari projects progress (progress)
				*/
					/* projecttask */
				$resultprogresses[$z] = pg_exec($dbconn, "select pjt_progresshistory.pjt_progresshistory_id,
				pjt_progresshistory.progress_project as amount, 
				to_char(pjt_progresshistory.created, 'mm') as bulan,
				to_char(pjt_progresshistory.created, 'dd') as tanggal,
				c_projectphase.c_project_id as project_id
						from pjt_progresshistory
						join c_projectphase
						on pjt_progresshistory.c_projectphase_id = c_projectphase.c_projectphase_id
						where c_projectphase.c_project_id = '$projectid'
						order by pjt_progresshistory.created");

				/*
					Query untuk mengisi value dari projects payments (payment plan)
				*/
				/*
					fin_payment.isreceipt = 'N'
					berarti payment out
				*/
				$resultpayments[$z] = pg_exec($dbconn, "select sum(finacc_txn_amount) as amount, to_char(paymentdate, 'MM') as bulan from fin_payment
				where fin_payment.c_project_id = '$projectid'
				and fin_payment.isreceipt = 'N'
				and to_char(created, 'YYYY') in (
					select to_char(c_period.startdate, 'YYYY') as custom_year
					from c_period
					join c_budgetline
					on c_budgetline.c_period_id = c_period.c_period_id
					group by c_period.name, startdate
					order by startdate
					limit 1
				)
				group by bulan
				order by bulan");

				$z++;
			}

	} else if (($_GET['project'] != '')&&($_GET['budget'] == '')) {
		
		/*
			Query untuk mengisi value dari budget
		*/
			/* projecttask */
		$result = pg_exec($dbconn, "select c_budgetline.amount as amount, c_period.startdate, c_period.name, c_budgetline.c_budget_id as budget_id, to_char(c_period.startdate, 'MM') as bulan
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
			c_budgetline.c_currency_id = '303' and c_projectphase.c_project_id = '$project_id'
			order by startdate");

		/*
			Query untuk mengisi value dari projects progress (progress)
		*/
			/* projecttask */
		$resultprogress = pg_exec($dbconn, "select pjt_progresshistory.pjt_progresshistory_id,
			pjt_progresshistory.progress_project as amount, 
			to_char(pjt_progresshistory.created, 'mm') as bulan,
			to_char(pjt_progresshistory.created, 'dd') as tanggal,
			c_projectphase.c_project_id as project_id
			from pjt_progresshistory
			join c_projectphase
			on pjt_progresshistory.c_projectphase_id = c_projectphase.c_projectphase_id
			where c_projectphase.c_project_id = '$project_id'
			order by pjt_progresshistory.created");

		/*
			Query untuk mengisi value dari projects payments (payment plan)
		*/
		$resultpayment = pg_exec($dbconn, "select sum(finacc_txn_amount) as amount, to_char(paymentdate, 'MM') as bulan from fin_payment
			where fin_payment.c_project_id = '$project_id'
				and fin_payment.isreceipt = 'N'
			and to_char(created, 'YYYY') in (
					select to_char(c_period.startdate, 'YYYY') as custom_year
					from c_period
					join c_budgetline
					on c_budgetline.c_period_id = c_period.c_period_id
					group by c_period.name, startdate
					order by startdate
					limit 1
				)
			group by bulan
			order by bulan");

	} else if (($_GET['project'] == '')&&($_GET['budget'] != '')) {
		/*
			Query untuk mengisi value dari budget
		*/
		/*
			c_currency_id = 303 
			berarti IDR
		*/
		$result = pg_exec($dbconn, "select c_budgetline.amount as amount, c_period.startdate, c_period.name, c_budgetline.c_budget_id as budget_id, to_char(c_period.startdate, 'MM') as bulan
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
				) and c_budgetline.c_currency_id = '303' and c_budgetline.c_budget_id = '$budget_id'
			order by startdate");

			$resultprojects = pg_exec($dbconn, "select * from c_project");

			$resultprogresses = array();
			$resultpayments = array();

			$z = 0;
			while($row = pg_fetch_array($resultprojects)) {
				$projectid = $row['c_project_id'];
				/*
					Query untuk mengisi value dari projects progress (progress)
				*/
				$resultprogresses[$z] = pg_exec($dbconn, "select pjt_progresshistory.pjt_progresshistory_id,
				pjt_progresshistory.progress_project as amount, 
				to_char(pjt_progresshistory.created, 'mm') as bulan,
				to_char(pjt_progresshistory.created, 'dd') as tanggal,
				c_projectphase.c_project_id as project_id
						from pjt_progresshistory
						join c_projectphase
						on pjt_progresshistory.c_projectphase_id = c_projectphase.c_projectphase_id
						where c_projectphase.c_project_id = '$projectid'
						order by pjt_progresshistory.created");
				/*select pjt_progresshistory.pjt_progresshistory_id,
				pjt_progresshistory.progress_project as amount, 
				to_char(pjt_progresshistory.created, 'mm') as bulan,
				to_char(pjt_progresshistory.created, 'dd') as tanggal,
				c_projectphase.c_project_id as project_id, c_projectphase.m_product_id, c_projectphase.c_projectphase_id
						from pjt_progresshistory
						join c_projectphase
						on pjt_progresshistory.c_projectphase_id = c_projectphase.c_projectphase_id
			join m_product
			on m_product.m_product_id = c_projectphase.m_product_id 
						join c_budgetline
						on m_product.m_product_id = c_budgetline.m_product_id
						order by pjt_progresshistory.created*/

				/*
					Query untuk mengisi value dari projects payments (payment plan)
				*/
				/*
					fin_payment.isreceipt = 'N'
					berarti payment out
				*/
				$resultpayments[$z] = pg_exec($dbconn, "select sum(finacc_txn_amount) as amount, to_char(paymentdate, 'MM') as bulan from fin_payment
				where fin_payment.c_project_id = '$projectid'
				and fin_payment.isreceipt = 'N'
				and to_char(created, 'YYYY') in (
					select to_char(c_period.startdate, 'YYYY') as custom_year
					from c_period
					join c_budgetline
					on c_budgetline.c_period_id = c_period.c_period_id
					group by c_period.name, startdate
					order by startdate
					limit 1
				)
				group by bulan
				order by bulan");

				$z++;
			}
		
	} else if (($_GET['project'] != '')&&($_GET['budget'] != '')) {
		/*
			Query untuk mengisi value dari budget
		*/
		
		$result = pg_exec($dbconn, "select c_budgetline.amount as amount, c_period.startdate, c_period.name, c_budgetline.c_budget_id as budget_id, to_char(c_period.startdate, 'MM') as bulan
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
			order by startdate");

		/*
			Query untuk mengisi value dari projects progress (progress)
		*/
		$resultprogress = pg_exec($dbconn, "select pjt_progresshistory.pjt_progresshistory_id,
			pjt_progresshistory.progress_project as amount, 
			to_char(pjt_progresshistory.created, 'mm') as bulan,
			to_char(pjt_progresshistory.created, 'dd') as tanggal,
			c_projectphase.c_project_id as project_id
			from pjt_progresshistory
			join c_projectphase
			on pjt_progresshistory.c_projectphase_id = c_projectphase.c_projectphase_id
			where c_projectphase.c_project_id = '$project_id'
			order by pjt_progresshistory.created");

		/*
			Query untuk mengisi value dari projects payments (payment plan)
		*/
		$resultpayment = pg_exec($dbconn, "select sum(finacc_txn_amount) as amount, to_char(paymentdate, 'MM') as bulan from fin_payment
			where fin_payment.c_project_id = '$project_id'
				and fin_payment.isreceipt = 'N'
			and to_char(created, 'YYYY') in (
					select to_char(c_period.startdate, 'YYYY') as custom_year
					from c_period
					join c_budgetline
					on c_budgetline.c_period_id = c_period.c_period_id
					group by c_period.name, startdate
					order by startdate
					limit 1
				)
			group by bulan
			order by bulan");
	}


	$numrows = pg_numrows($result);

	$data = array();
	$databudget = array();
	$datax = array();

	for($i = 0;$i<=11;$i++){
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
	$rowbefore;

	if ($_GET['budget'] != "" && $_GET['project'] != "") {
	  	while($row = pg_fetch_array($result)) {
	  		if ($rowbefore["name"] == $row["name"]) {
				if($_GET['budget'] == $row["budget_id"]) {
				   $total += $row["amount"];
				   $databudget[$i-1] = (float)$total;
				}
			}
			else {
			   if($_GET['budget'] == $row["budget_id"]) {
				   $total += $row["amount"];
				}

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
	$databudget[0] = ($databudget[0]/$total)*100;
	$databudget[1] = ($databudget[1]/$total)*100;
	$databudget[2] = ($databudget[2]/$total)*100;
	$databudget[3] = ($databudget[3]/$total)*100;
	$databudget[4] = ($databudget[4]/$total)*100;
	$databudget[5] = ($databudget[5]/$total)*100;
	$databudget[6] = ($databudget[6]/$total)*100;
	$databudget[7] = ($databudget[7]/$total)*100;
	$databudget[8] = ($databudget[8]/$total)*100;
	$databudget[9] = ($databudget[9]/$total)*100;
	$databudget[10] = ($databudget[10]/$total)*100;
	$databudget[11] = ($databudget[11]/$total)*100;

	for($i = 0;$i<=11;$i++){
		$databudget[$i] = round($databudget[$i], 2);
		if($databudget[$i] < $databudget[$i-1]){
			$databudget[$i] = $databudget[$i-1];
		}
	}

	/*
		Lanjutan query untuk mengisi value dari projects progress (progress)
	*/
	$dataprogress = array();
	$dataprogresses = array();
	$total_progresses = array();
	for($i = 0;$i<=11;$i++){
		$dataprogress[$i] = 0;
	}
	if(isset($_GET['project']) && $_GET['project'] != ""){
		while($row = pg_fetch_array($resultprogress)) {
			$dataprogress[(int)$row['bulan']-1] = (int)$row["amount"];
		}


		for($i = 0;$i<=11;$i++){
			if($dataprogress[$i] < $dataprogress[$i-1]){
				$dataprogress[$i] = $dataprogress[$i-1];
			}
		}
	} else {
		for($m=0;$m<count($resultprogresses);$m++){
			$data_progress = array();
			for($s = 0;$s<=11;$s++){
				$data_progress[$s] = 0;
			}
			while($row = pg_fetch_array($resultprogresses[$m])) {
				$data_progress[(int)$row['bulan']-1] = (int)$row["amount"];
			}

			for($i = 0;$i<=11;$i++){
				if($data_progress[$i] < $data_progress[$i-1]){
					$data_progress[$i] = $data_progress[$i-1];
				}
			}
			$dataprogresses[$m] = $data_progress;
		}
		for($i = 0;$i<=11;$i++){
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
	for($i = 0;$i<=11;$i++){
		$datapayment[$i] = 0;
	}
	if(isset($_GET['project']) && $_GET['project'] != ""){
		$total = 0;
		while($row = pg_fetch_array($resultpayment)) {
			$total += $row['amount'];
			$datapayment[(int)$row['bulan']-1] = (int)$total;
		}

		for($i = 0;$i<=11;$i++){
			if($datapayment[$i] < $datapayment[$i-1]){
				$datapayment[$i] = $datapayment[$i-1];
			}
		}
		if($total == 0) $total = 1;
		for($i = 0;$i<=11;$i++){
			$datapayment[$i] = $datapayment[$i]/$total*100;
		}
	} else {
		for($m=0;$m<count($resultpayments);$m++){
			$data_payment = array();
			for($s = 0;$s<=11;$s++){
				$data_payment[$s] = 0;
			}
			$total = 0;
			while($row = pg_fetch_array($resultpayments[$m])) {
				$total += $row['amount'];
				$data_payment[(int)$row['bulan']-1] = (int)$total;
			}

			for($i = 0;$i<=11;$i++){
				if($data_payment[$i] < $data_payment[$i-1]){
					$data_payment[$i] = $data_payment[$i-1];
				}
			}

			for($i = 0;$i<=11;$i++){
				$data_payment[$i] = $data_payment[$i]/$total*100;
			}

			$datapayments[$m] = $data_payment;
		}
		for($i = 0;$i<=11;$i++){
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