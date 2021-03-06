<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "dbcon.php";
$barCount = 71;
$firstyear = 2010;

/**
 * Query untuk mengisi value dari budget
 * @global int $firstyear
 * @param type $project_id
 * @param type $budget_id
 * @return type
 */
function getBudgetQuery($project_id, $budget_id, $year) {
	global $firstyear;
	$retval = "select c_budgetline_id, c_budgetline.c_project_id as project_id, c_budgetline.em_bgt_c_projectphase_id as project_phase, c_budgetline.em_bgt_c_projecttask_id as project_task,
			(c_budgetline.amount/1000000) as amount, em_pjt_phasegroup_id, ppg.name, cp.name as projectName,
			c_currency_convert(amount, '303','100',c_period.startdate, null, '*')/1000 as amount_usd, c_budgetline.c_budget_id as name ,c_budgetline.c_budget_id as budget,
			c_period.startdate as actualdate, date_part('year',c_period.startdate) as actualyear, c_period.name as period_name, c_budgetline.c_budget_id as budget_id, (date_part('year',c_period.startdate) -  " . $firstyear . ") * 12 + date_part('month',c_period.startdate) as bulan
		from c_period left outer join c_budgetline on c_budgetline.c_period_id = c_period.c_period_id
		left outer join c_projectphase pp on c_budgetline.em_bgt_c_projectphase_id = pp.c_projectphase_id
		left outer join pjt_phasegroup ppg on ppg.pjt_phasegroup_id = pp.em_pjt_phasegroup_id
		left outer join c_project cp on pp.c_project_id = cp.c_project_id
		where c_period.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C' and c_budgetline.c_project_id " . $project_id . "  and c_budgetline.c_budget_id  " . $budget_id . " and date_part('year',c_period.startdate) " . $year . " order by c_period.startdate;";
	return $retval;
}

/**
 * Query untuk mengisi value dari projects progress (progress)
 * @global int $firstyear
 * @param type $project_id
 * @return type
 */
function getProjectProgressQuery($project_id, $year) {
	global $firstyear;
	$retval = "
		select pjt_progresshistory.pjt_progresshistory_id,	pjt_progresshistory.progress_project as amount, 
		(date_part('year',pjt_progresshistory.created) - " . $firstyear . ") * 12 + date_part('month',pjt_progresshistory.created) as bulan,
		to_char(pjt_progresshistory.created, 'dd') as tanggal,c_projectphase.c_project_id as project_id
		from pjt_progresshistory join c_projectphase on pjt_progresshistory.c_projectphase_id = c_projectphase.c_projectphase_id
		where c_projectphase.c_project_id " . $project_id . "
		and date_part('year',pjt_progresshistory.created) " . $year . " and c_projectphase.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C'
		order by pjt_progresshistory.created";
	return $retval;
}

/**
 * Query untuk mengisi value dari projects payments (payment plan)
 * @param type $project_id
 * @return type
 */
function getPaymentPlan($project_id, $year) {
	global $firstyear;
	$retval = "
		select ((o.grandtotal*p.percentage/100)/1000000) as amount, ((date_part('year',duedate) -  " . $firstyear . ") * 12 + date_part('month',duedate))::integer as bulan, c_currency_convert(amount, '303','100',duedate, null, '*')/1000 as amount_usd
				from por_payment_schedule p
				inner join c_order o on p.c_order_id = o.c_order_id
			where o.c_project_id " . $project_id . "
			and date_part('year',duedate) " . $year . " and p.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C'
			order by bulan";
	return $retval;
}

/**
 * get actual payment
 * @global int $firstyear
 * @param type $project_id
 * @return string
 */
function getActualPaymentQuery($project_id) {
	global $firstyear;
	$retval = "select 
			invl.c_project_id as project_id,pt.c_projectphase_id as project_phase,pt.c_projecttask_id as project_task,inv.dateinvoiced as actualdate, (invl.priceactual*invl.qtyinvoiced)/1000000 as amount,
			c_currency_convert(invl.priceactual*invl.qtyinvoiced, '303','100',inv.dateinvoiced, null, '*')/1000 as amount_usd,
			(date_part('year',inv.dateinvoiced) - " . $firstyear . ") * 12 + date_part('month',inv.dateinvoiced) as bulan
		from c_invoiceline invl
			inner join c_invoice inv on invl.c_invoice_id = inv.c_invoice_id
			inner join c_projecttask pt on pt.m_product_id = (case invl.bom_parent_id when null then invl.m_product_id else invl.bom_parent_id end)
		where  invl.c_project_id  " . $project_id . "  and  inv.ispaid = 'Y' and inv.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C' order by inv.dateinvoiced ";
	return $retval;
}

function getBudgetVsCostQuery($project_id, $budget_id, $currency = "idr") {
	$cost = "ROUND((C_INVOICELINE.priceactual*C_INVOICELINE.qtyinvoiced/1000000), 2)";
	$budget = "round(cbl.amount/1000000, 2)";
	if ($currency == "usd") {
		$cost = "c_currency_convert(C_INVOICELINE.priceactual*C_INVOICELINE.qtyinvoiced, "
				. "'303', '100', '2012-10-10'::date, null, "
				. "'142F2095A9FE48ECB13CD19A06A0BD9C')/1000";
		$budget = "ROUND(cbl.amount/cb.em_bgt_kurs, 2)/1000";
	}

	$query = <<<PGSQL
		select 
			cb."name" as budget_name, 
			cb.c_budget_id as budget_id, 
			cp."name" as project_name, 
			cp.c_project_id as project_id, 
			pg."name" as group_name, 
			pg.pjt_phasegroup_id as group_id, 
			pp."name" as phase_name, 
			pp.c_projectphase_id as phase_id, 
			pt."name" as task_name, 
			pt.c_projecttask_id as task_id, 
			coalesce(sum({$budget}), 0) as budget,
			coalesce(sum(cost.total), 0) as total_cost,
			coalesce(sum(cost.thn2010), 0) as thn2010,
			coalesce(sum(cost.thn2011), 0) as thn2011,
			coalesce(sum(cost.thn2012), 0) as thn2012,
			coalesce(sum(cost.thn2013), 0) as thn2013,
			coalesce(sum(cost.thn2014), 0) as thn2014,
			coalesce(sum(cost.thn2015), 0) as thn2015
		from c_projecttask pt 
		left join c_projectphase pp on pt.c_projectphase_id = pp.c_projectphase_id
		left outer join pjt_phasegroup pg on pp.em_pjt_phasegroup_id = pg.pjt_phasegroup_id
		left join c_budgetline cbl on cbl.em_bgt_c_projecttask_id = pt.c_projecttask_id
		left join c_budget cb on cbl.c_budget_id = cb.c_budget_id
		left join c_project cp on cp.c_project_id = pp.c_project_id
		left join (
			SELECT 
				c_projecttask.c_projecttask_id,
				SUM(CASE WHEN date_part('year', c_invoice.dateacct) 
					BETWEEN '2010' AND '2015' THEN {$cost} END) as total,
				SUM(CASE WHEN date_part('year', c_invoice.dateacct)  = '2010' 
						THEN {$cost} ELSE 0 END) AS thn2010,
				SUM(CASE WHEN date_part('year', c_invoice.dateacct)  = '2011' 
						THEN {$cost} ELSE 0 END) AS thn2011,
				SUM(CASE WHEN date_part('year', c_invoice.dateacct)  = '2012' 
						THEN {$cost} ELSE 0 END) AS thn2012,
				SUM(CASE WHEN date_part('year', c_invoice.dateacct)  = '2013' 
						THEN {$cost} ELSE 0 END) AS thn2013,
				SUM(CASE WHEN date_part('year', c_invoice.dateacct)  = '2014' 
						THEN {$cost} ELSE 0 END) AS thn2014,
				SUM(CASE WHEN date_part('year', c_invoice.dateacct)  = '2015' 
						THEN {$cost} ELSE 0 END) AS  thn2015,
				MAX(c_projecttask."name")
			FROM C_PROJECTTASK
			JOIN C_INVOICELINE ON C_PROJECTTASK.M_PRODUCT_ID = C_INVOICELINE.M_PRODUCT_ID
			JOIN C_INVOICE ON C_INVOICELINE.C_INVOICE_ID = C_INVOICE.C_INVOICE_ID
			JOIN C_PROJECTPHASE ON C_PROJECTTASK.C_PROJECTPHASE_ID = C_PROJECTPHASE.C_PROJECTPHASE_ID
			JOIN C_PROJECT ON C_INVOICE.C_PROJECT_ID = C_PROJECT.C_PROJECT_ID
			WHERE C_INVOICE.ISPAID = 'Y'
			AND C_INVOICE.DOCSTATUS = 'CO'
			AND C_PROJECTPHASE.C_PROJECT_ID = C_PROJECT.C_PROJECT_ID
			GROUP BY c_projecttask.c_projecttask_id
		) as cost
			on pt.c_projecttask_id = cost.c_projecttask_id
		where cb.c_budget_id {$budget_id}
			AND cp.c_project_id {$project_id}
		group by cb."name", 
			cb.c_budget_id, 
			cp."name", 
			cp.c_project_id , 
			pg."name", 
			pg.pjt_phasegroup_id, 
			pp."name", 
			pp.c_projectphase_id, 
			pt."name", 
			pt.c_projecttask_id
PGSQL;

	return $query;
}

function getBudgetComparison($budget1, $budget2, $project_id, $currency = "idr") {
	$amountBudget = "round(cbl.amount/1000000, 2)";
	if ($currency == "usd")
		$amountBudget = "ROUND(cbl.amount/cb.em_bgt_kurs, 2)/1000";

	$query = <<<PGSQL
			SELECT	project_name, group_name, em_pjt_phasegroup_id, phase_name, 
					c_projectphase_id, task_name, project_task,
					COALESCE(ROUND(sum(case when c_budget_id {$budget1} then amountbudget else 0 end), 2), 0) as budget1,
					COALESCE(ROUND(sum(case when c_budget_id {$budget2} then amountbudget else 0 end), 2), 0) as budget2
		FROM ( select cb.name as budget_name, cbl.c_budget_id, 
			cp.name as project_name,pp.c_project_id,	
			pg.name as group_name, pp.em_pjt_phasegroup_id,
			pp.name as phase_name, pp.c_projectphase_id,	
			pt.name as task_name, pt.c_projecttask_id as project_task,  
			{$amountBudget} as amountbudget
			from c_projecttask pt 
			left join c_projectphase pp on pt.c_projectphase_id = pp.c_projectphase_id
			left outer join pjt_phasegroup pg on pp.em_pjt_phasegroup_id = pg.pjt_phasegroup_id
			left join c_budgetline cbl on cbl.em_bgt_c_projecttask_id = pt.c_projecttask_id
			left join c_budget cb on cbl.c_budget_id = cb.c_budget_id
			left join c_project cp on cp.c_project_id = pp.c_project_id
			where pp.c_project_id is not null and cb.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C' order by project_name, group_name desc, phase_name, task_name) as foo
			group by project_name, group_name, em_pjt_phasegroup_id, phase_name, c_projectphase_id, task_name, project_task
PGSQL;

	return $query;
}

function getBudgetBuildingQuery($currency = "idr") {
	$budget = "SUM(cbl.amount)/1000000";
	if ($currency == "usd") {
		$budget = "SUM(cbl.amount/cb.em_bgt_kurs)/1000";
	}
	$query = <<<PGSQL
		SELECT
			cb."name",
			COALESCE(ROUND({$budget}, 2), 0) AS budget,
			COALESCE(cb.em_bgt_constructionarea, 0) AS gross_floor_area,
			COALESCE(ROUND({$budget}/cb.em_bgt_constructionarea), 0) AS budget_per_gross,
			COALESCE(cb.em_bgt_rentarea, 0) AS rent_floor_area,
			COALESCE(ROUND({$budget}/cb.em_bgt_rentarea), 0) AS budget_per_nett
		FROM c_budget cb
		LEFT JOIN c_budgetline cbl 
			ON cb.c_budget_id = cbl.c_budget_id
		GROUP BY cb."name", cb.em_bgt_constructionarea, cb.em_bgt_rentarea, 
			cb.em_bgt_constructionarea			
PGSQL;
	return $query;
}

/**
 * return total budget value all year from the start
 * wll never close the connection given
 * @param type $dbconn koneksi db
 * @param type $budget_id taro param disini kyk contoh2 yang lainnya
 * @param type $project_id taro param disini kyk contoh2 yang lainnya
 * @return type
 */
function getTotalBudget($dbconn, $budget_id, $project_id) {
	$query = "select sum(amount/1000000) as total from c_budget c inner join c_budget_line cb on c.c_budget_id = cb.c_budget_id where c.c_budget_id " . $budget_id . " and cb.c_project_id " . $project_id .
			" and cb.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C' ";
	$result = pg_exec($dbconn, $query);
	$row = pg_fetch_array($result);
	return $row['total'];
}

/**
 * ambil quer
 * @param type $project_id
 * @param type $budget_id
 */
function getRealBudget($dbconn, $project_id, $budget_id, $currency = NULL) {
	global $firstyear, $barCount;
	$query = "select (date_part('year',p.startdate) -  " . $firstyear . ")  * 12 + date_part('month',p.startdate) as bulan,	sum(amount/1000000) as amount, sum(amount/cb.em_bgt_kurs)/1000 as amount_usd
			  from c_budgetline bl inner join c_period p on bl.c_period_id = p.c_period_id inner join c_budget cb on cb.c_budget_id = bl.c_budget_id
			  where bl.c_project_id " . $project_id . " and bl.c_budget_id " . $budget_id . " group by bulan order by bulan ";
	$result = pg_exec($dbconn, $query);
	$data = array();
	while ($row = pg_fetch_array($result)) {
		$index = $row['bulan'];
		while (count($data) < $index) {
			array_push($data, 0);
		}
		if ($currency == 'usd') {
			array_push($data, $row['amount_usd']);
		} else {
			array_push($data, $row['amount']);
		}
	}
	while (count($data) <= $barCount) {
		array_push($data, 0);
	}
	pg_free_result($result);
	return $data;
}

/**
 * ambil quer
 * @param type $project_id
 * @param type $budget_id
 */
function getProgressInvoiceBased($dbconn, $project_id) {
	global $firstyear, $barCount;
	$query = "select 	sum((invl.priceactual*invl.qtyinvoiced)/1000000) as amount,(date_part('year',inv.dateinvoiced) - " . $firstyear . ") * 12 + date_part('month',inv.dateinvoiced) as bulan
				from c_invoiceline invl
					inner join c_invoice inv on invl.c_invoice_id = inv.c_invoice_id
					inner join c_projecttask pt on pt.m_product_id = (case invl.bom_parent_id when null then invl.m_product_id else invl.m_product_id end)
				where  invl.c_project_id  " . $project_id . "  and  inv.ispaid = 'Y' and inv.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C' 
				group by bulan order by bulan ;";
	$result = pg_exec($dbconn, $query);
	$data = array();
	while ($row = pg_fetch_array($result)) {
		$index = $row['bulan'];
		while (count($data) < $index) {
			array_push($data, 0);
		}
		array_push($data, $row['amount']);
	}
	while (count($data) <= $barCount) {
		array_push($data, 0);
	}
	pg_free_result($result);
	return $data;
}

/**
 * ambil quer
 * @param type $project_id
 * @param type $budget_id
 */
function getRealPaymentPlan($dbconn, $project_id, $currency = NULL) {
	global $firstyear, $barCount;
	$query = "select sum(((o.grandtotal*p.percentage/100)/1000000)) as amount, ((date_part('year',duedate) - " . $firstyear . " ) * 12 + date_part('month',duedate))::integer as bulan, sum(c_currency_convert(amount, '303','100',duedate, null, '*')/1000) as amount_usd
				from por_payment_schedule p
				inner join c_order o on p.c_order_id = o.c_order_id
			where o.c_project_id " . $project_id . "
			and true and p.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C'
			group by bulan order by bulan";
	$result = pg_exec($dbconn, $query);
	$data = array();
	while ($row = pg_fetch_array($result)) {
		$index = $row['bulan'];
		while (count($data) < $index) {
			array_push($data, 0);
		}
		if ($currency == 'usd') {
			array_push($data, $row['amount_usd']);
		} else {
			array_push($data, $row['amount']);
		}
	}
	while (count($data) <= $barCount) {
		array_push($data, 0);
	}
	pg_free_result($result);
	return $data;
}

//$dbconn = pg_connect("host=localhost dbname=openbravo user=postgres password=postgres") or die('Could not connect: ' . pg_last_error());


