<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi graph of budget and cashflow
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @version    1.1
	 */
	 
	include "dbcon.php";
	$barCount = 35;
	$firstyear = 2011;
	
	if(isset($_GET['budget'])){
		$budget_id = " = '".$_GET['budget']."'";
	} else {
		$budget_id = " is not null ";
	}
	
	//$budget_id = $_GET['budget'];


	$resultx = pg_exec($dbconn, "select c_period.name, startdate
			from c_period
			join c_budgetline
			on c_budgetline.c_period_id = c_period.c_period_id
			where true
			group by c_period.name, startdate
			order by startdate");
	
	
		//$budget = $_GET['budget'];
		/*
			Query untuk mengisi value dari budget plan
		*/
		$result_budgetplan = pg_exec($dbconn, "select c_budgetline.amount, c_period.startdate, (date_part('year',c_period.startdate) - ".$firstyear.") * 12 + date_part('month',c_period.startdate) as month, c_period.name, c_budget_id, c_currency_id
			from c_budgetline
			join c_period
			on c_budgetline.c_period_id = c_period.c_period_id
			where c_budget_id ".$budget_id." 
			order by startdate");
/*select c_budgetline.amount, c_period.startdate, 
(date_part('year',c_period.startdate) - 2011) * 12 + date_part('month',c_period.startdate) as month, c_period.name, c_budget_id, c_currency_id
			from c_budgetline
			join c_period
			on c_budgetline.c_period_id = c_period.c_period_id
			where c_budget_id is not null 
			order by startdate*/

			
		/*
			Query untuk mengisi value dari total budget
		*/
		/*$result_totalbudget = pg_exec($dbconn, "select c_budgetline.amount as amount, c_period.startdate, c_period.name, c_budgetline.c_budget_id as budget_id
			from c_budgetline
			join c_period
			on c_budgetline.c_period_id = c_period.c_period_id
			where  c_budget_id  ".$budget_id." 
			and true
			order by startdate");*/

		/*
			Query untuk mengisi value dari payment plan
		*/
			/* projecttask */
		$result_paymentplan = pg_exec($dbconn, "select fin_payment.finacc_txn_amount as amount,(date_part('year',fin_payment.paymentdate) - ".$firstyear.") * 12 + date_part('month',fin_payment.paymentdate) as  month,
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
			where fin_payment.isreceipt = 'N' and true
			and c_projectphase.c_projectphase_id not in (select c_projecttask.c_projectphase_id from c_projecttask)
			and c_budgetline.c_budget_id  ".$budget_id." 
			group by month, tahun, c_budget_id, fin_payment.finacc_txn_amount
			order by tahun, month");
/*select fin_payment.finacc_txn_amount as amount,
(date_part('year',fin_payment.paymentdate) - 2011) * 12 + date_part('month',fin_payment.paymentdate) as  month,
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
			where fin_payment.isreceipt = 'N' and true
			and c_projectphase.c_projectphase_id not in (select c_projecttask.c_projectphase_id from c_projecttask)
			and c_budgetline.c_budget_id  is not null 
			group by month, tahun, c_budget_id, fin_payment.finacc_txn_amount
			order by tahun, month*/


	$data = array();
	$databudgetplan = array();
	$datatotalbudget = array();
	$datax = array();
	$pembagi = 1;

	while($row = pg_fetch_array($resultx)) {
		$datax[] = $row["name"];
	}

	for($i = 0;$i<=$barCount;$i++){
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
				$databudgetplan[(int)$row['month']-1] = (float)$row["amount"]/$pembagi;
			} else {
				if(isset($data_conv[$row["c_currency_id"]])){
					$databudgetplan[(int)$row['month']-1] = (float)$row["amount"]*$data_conv[$row["c_currency_id"]]/$pembagi;
				}
			}
	   // $databudgetplan[(int)$row['month']-1] = (float)$row["amount"];
	}
	

	/*
		Total Budget
	*/
	/*$total = 0;
	$i = 0;
	$rowbefore;

	if (isset($_GET['budget'])) {
	  	while($row = pg_fetch_array($result_totalbudget)) {
	  		if ($rowbefore["name"] == $row["name"]) {
				if($_GET['budget'] == $row["budget_id"]) {
				   $total += $row["amount"];
				   $datatotalbudget[$i-1] = (float)$total/$pembagi;
				}
			}
			else {
			   if($_GET['budget'] == $row["budget_id"]) {
				   $total += $row["amount"];
				}

				$datatotalbudget[] = (float)$total/$pembagi;
			   $rowbefore = $row;
			   $i = $i+1;
			}
		}
	} else {
		while($row = pg_fetch_array($result_totalbudget)) {
			$total += $row["amount"];
		   $datatotalbudget[] = (float)$total/$pembagi;
		}
	}*/


	$totalbudget = array();
	for($i = 0;$i<=$barCount;$i++){
		$totalbudget[$i] = 0;
		for($j = 0;$j<=$i;$j++){
			$totalbudget[$i] = $totalbudget[$i] + $databudgetplan[$j]/$pembagi;
		}
	}

	/*
		Payment plan
	*/
	$datapayment = array();
	for($i = 0;$i<=$barCount;$i++){
		$datapayment[$i] = 0;
	}
	$rowbefore;
  	while($row = pg_fetch_array($result_paymentplan)) {
  		if($rowbefore['month'] == $row['month']){
			$datapayment[(int)$row['month']-1] = ($datapayment[(int)$row['month']-1]+(float)$row['amount'])/$pembagi;
  		} else {
  			$datapayment[(int)$row['month']-1] = (float)$row['amount']/$pembagi;
  		}

		$rowbefore = $row;
	}

	/*
		Total Payment
	*/
	$datatotalpayment = array();
	for($i = 0;$i<=$barCount;$i++){
		$datatotalpayment[$i] = 0;
		for($j = 0;$j<=$i;$j++){
			$datatotalpayment[$i] = $datatotalpayment[$i] + $datapayment[$j]/$pembagi;
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