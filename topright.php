<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi graph of budget and cashflow
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @version    1.1
	 */
	 
	include "dbcon.php";
	
	$budget_id = $_GET['budget'];


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
	
	//awal buka page dashboard
	if(isset($_GET['budget'])){
		/*
			ketika $_GET['budget'] tidak terdefinisi
		*/
		$budget = $_GET['budget'];
		/*
			Query untuk mengisi value dari budget plan
		*/
		$result_budgetplan = pg_exec($dbconn, "select c_budgetline.amount, c_period.startdate, to_char(c_period.startdate, 'MM') as month, c_period.name, c_budget_id, c_currency_id
			from c_budgetline
			join c_period
			on c_budgetline.c_period_id = c_period.c_period_id
			where c_budget_id = '$budget'
			order by startdate");
			
		/*
			Query untuk mengisi value dari total budget
		*/
		$result_totalbudget = pg_exec($dbconn, "select c_budgetline.amount as amount, c_period.startdate, c_period.name, c_budgetline.c_budget_id as budget_id
			from c_budgetline
			join c_period
			on c_budgetline.c_period_id = c_period.c_period_id
			where  c_budget_id = '$budget'
			and to_char(startdate, 'YYYY') in (
					select to_char(c_period.startdate, 'YYYY') as custom_year
					from c_period
					join c_budgetline
					on c_budgetline.c_period_id = c_period.c_period_id
					group by c_period.name, startdate
					order by startdate
					limit 1
				)
			order by startdate");

		/*
			Query untuk mengisi value dari payment plan
		*/
			/* projecttask */
		$result_paymentplan = pg_exec($dbconn, "select fin_payment.finacc_txn_amount as amount, to_char(fin_payment.paymentdate, 'MM') as month,
			to_char(fin_payment.paymentdate, 'YY') as tahun,
			c_budgetline.c_budget_id
			from fin_payment
			join c_project
			on c_project.c_project_id = fin_payment.c_project_id
			join c_projectphase
			on c_project.c_project_id = c_projectphase.c_project_id
			join m_product
			on m_product.m_product_id = c_projectphase.m_product_id
			join c_budgetline
			on m_product.m_product_id = c_budgetline.m_product_id 
			where fin_payment.isreceipt = 'N' and to_char(fin_payment.paymentdate, 'YY') in (
					select to_char(c_period.startdate, 'YY') as custom_year
					from c_period
					join c_budgetline
					on c_budgetline.c_period_id = c_period.c_period_id
					group by startdate
					order by startdate
					limit 1
				)
			and c_projectphase.c_projectphase_id not in (select c_projecttask.c_projectphase_id from c_projecttask)
			and c_budgetline.c_budget_id = '$budget_id' 
			group by month, tahun, c_budget_id, fin_payment.finacc_txn_amount
			order by tahun, month");
		/*
			Query untuk mengisi value dari total payment
			tidak dipakai, data diambil dr result_paymentplan
		*/
			/* projecttask */
		// $result_totalpayment = pg_exec($dbconn, "select fin_payment.finacc_txn_amount as amount, to_char(paymentdate, 'MM') as month,
		// 	to_char(paymentdate, 'YY') as tahun,
		// 	c_budgetline.c_budget_id
		// 	from fin_payment
		// 	join c_project
		// 	on c_project.c_project_id = fin_payment.c_project_id
		// 	join c_projectphase
		// 	on c_project.c_project_id = c_projectphase.c_project_id
		// 	join m_product
		// 	on m_product.m_product_id = c_projectphase.m_product_id
		// 	join c_budgetline
		// 	on m_product.m_product_id = c_budgetline.m_product_id 
		// 	where c_budgetline.c_budget_id = '$budget_id' 
		// 		and fin_payment.isreceipt = 'N'
		// 	and to_char(paymentdate, 'YY') in (
		// 			select to_char(c_period.startdate, 'YYYY') as custom_year
		// 			from c_period
		// 			join c_budgetline
		// 			on c_budgetline.c_period_id = c_period.c_period_id
		// 			group by c_period.name, startdate
		// 			order by startdate
		// 			limit 1
		// 		)
		// 	group by month, tahun, c_budget_id, fin_payment.finacc_txn_amount
		// 	order by month");

	} else {
		/*
			ketika $_GET['budget'] terdefinisi
		*/
		/*
			Query untuk mengisi value dari budget plan
		*/
		$result_budgetplan = pg_exec($dbconn, "select c_budgetline.amount, c_period.startdate, to_char(c_period.startdate, 'MM') as month, c_period.name, c_budget_id, c_currency_id
			from c_budgetline
			join c_period
			on c_budgetline.c_period_id = c_period.c_period_id
			where c_budget_id = (select c_budget_id from c_budget order by created desc limit 1)
			order by startdate");
	//			
		/*
			Query untuk mengisi value dari total budget
		*/
		$result_totalbudget = pg_exec($dbconn, "select c_budgetline.amount, c_period.startdate, to_char(c_period.startdate, 'MM') as month, c_period.name, c_budget_id, c_currency_id
			from c_budgetline
			join c_period
			on c_budgetline.c_period_id = c_period.c_period_id
			where c_budget_id = (select c_budget_id from c_budget order by created desc limit 1)
			order by startdate");

		/*
			Query untuk mengisi value dari payment plan
			subquery di sini, untuk mengambil tahun dari c_budgetline terakhir
		*/
			/* projecttask 
			hanya yang tidak memiliki projecttask
				and c_projectphase.c_projectphase_id not in (select c_projecttask.c_projectphase_id from c_projecttask)
			terus digabung dengan query yg dari project task
			*/
		$result_paymentplan = pg_exec($dbconn, "select fin_payment.finacc_txn_amount as amount, to_char(fin_payment.paymentdate, 'MM') as month,
			to_char(fin_payment.paymentdate, 'YY') as tahun,
			c_budgetline.c_budget_id
			from fin_payment
			join c_project
			on c_project.c_project_id = fin_payment.c_project_id
			join c_projectphase
			on c_project.c_project_id = c_projectphase.c_project_id
			join m_product
			on m_product.m_product_id = c_projectphase.m_product_id
			join c_budgetline
			on m_product.m_product_id = c_budgetline.m_product_id 
			where fin_payment.isreceipt = 'N' and to_char(fin_payment.paymentdate, 'YY') in (
					select to_char(c_period.startdate, 'YY') as custom_year
					from c_period
					join c_budgetline
					on c_budgetline.c_period_id = c_period.c_period_id
					group by startdate
					order by startdate
					limit 1
				)
			and c_projectphase.c_projectphase_id not in (select c_projecttask.c_projectphase_id from c_projecttask)
			group by month, tahun, c_budget_id, fin_payment.finacc_txn_amount
			order by tahun, month");

		/*
			Query untuk mengisi value dari total payment
			ga dipake, data diambil dr result_paymentplan
		*/
			/* projecttask */
		// $result_totalpayment = pg_exec($dbconn, "select fin_payment.amount as amount, to_char(paymentdate, 'MM') as month,
		// 	to_char(paymentdate, 'YY') as tahun,
		// 	c_budgetline.c_budget_id
		// 	from fin_payment
		// 	join c_project
		// 	on c_project.c_project_id = fin_payment.c_project_id
		// 	join c_projectphase
		// 	on c_project.c_project_id = c_projectphase.c_project_id
		// 	join m_product
		// 	on m_product.m_product_id = c_projectphase.m_product_id
		// 	join c_budgetline
		// 	on m_product.m_product_id = c_budgetline.m_product_id 
		// 	and to_char(paymentdate, 'YY') = to_char(now(), 'YY')
		// 	group by month, tahun, c_budget_id, fin_payment.amount
		// 	order by month");

	}

	$data = array();
	$databudgetplan = array();
	$datatotalbudget = array();
	$datax = array();

	while($row = pg_fetch_array($resultx)) {
		$datax[] = $row["name"];
	}

	for($i = 0;$i<=11;$i++){
		$databudgetplan[$i] = 0;
	}

	/* Conversion */
	$data_conv = array();
	$query_conv = "select multiplyrate,dividerate,c_currency_id,c_currency_id_to, validfrom, validto
		from c_conversion_rate 
		where validfrom < now() and validto > now() 
		and isactive = 'Y' and c_currency_id_to = '303'";
		// and isactive = 'Y' and c_currency_id_to = '102'";
	$result_conv = pg_exec($dbconn, $query_conv);
  	while($row = pg_fetch_array($result_conv)){
  			$data_conv[(int)$row['c_currency_id']] = (float)$row['multiplyrate'];
  	}

  	/*
		Budget Plan
	*/
	$total = 0;
  	while($row = pg_fetch_array($result_budgetplan)){
  		if($row["c_currency_id"]=='303'){
				$databudgetplan[(int)$row['month']-1] = (float)$row["amount"];
			} else {
				if(isset($data_conv[$row["c_currency_id"]])){
					$databudgetplan[(int)$row['month']-1] = (float)$row["amount"]*$data_conv[$row["c_currency_id"]];
				}
			}
	   // $databudgetplan[(int)$row['month']-1] = (float)$row["amount"];
	}
	

	/*
		Total Budget
	*/
	$total = 0;
	$i = 0;
	$rowbefore;

	if (isset($_GET['budget'])) {
	  	while($row = pg_fetch_array($result_totalbudget)) {
	  		if ($rowbefore["name"] == $row["name"]) {
				if($_GET['budget'] == $row["budget_id"]) {
				   $total += $row["amount"];
				   $datatotalbudget[$i-1] = (float)$total;
				}
			}
			else {
			   if($_GET['budget'] == $row["budget_id"]) {
				   $total += $row["amount"];
				}

				$datatotalbudget[] = (float)$total;
			   // $datax[] = $row["name"];
			   $rowbefore = $row;
			   $i = $i+1;
			}
		}
	} else {
		while($row = pg_fetch_array($result_totalbudget)) {
			$total += $row["amount"];
		   $datatotalbudget[] = (float)$total;
		   // $datax[] = $row["name"];
		}
	}

	/*
		Payment plan
	*/
	$datapayment = array();
	for($i = 0;$i<=11;$i++){
		$datapayment[$i] = 0;
	}
	$rowbefore;
  	while($row = pg_fetch_array($result_paymentplan)) {
  		if($rowbefore['month'] == $row['month']){
			$datapayment[(int)$row['month']-1] = ($datapayment[(int)$row['month']-1]+(float)$row['amount']);//1000000;
  		} else {
  			$datapayment[(int)$row['month']-1] = (float)$row['amount'];//1000000;
  		}

		$rowbefore = $row;
	}

	/*
		Total Payment
	*/
	$datatotalpayment = array();
	for($i = 0;$i<=11;$i++){
		$datatotalpayment[$i] = 0;
		for($j = 0;$j<=$i;$j++){
			$datatotalpayment[$i] = $datatotalpayment[$i] + $datapayment[$j];
		}
	}

	$data['budgetplan'] = $databudgetplan; 
	$data['totalbudget'] = $datatotalbudget; 

	$data['paymentplan'] = $datapayment; 
	$data['totalpayment'] = $datatotalpayment;
	$data['datax'] = $datax;

	// free memory
	pg_free_result($result_budgetplan);
	// close connection
	pg_close($dbh);
	
	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>