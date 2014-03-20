<?php

function getCleanParam($arr, $key) {
	if (isset($arr[$key]) && strlen($arr[$key]) > 2 && $arr[$key] != 'undefined') {
		return " = '" . $arr[$key] . "' ";
	}
	return " is not null ";
}

function getActualYearAmount($dbconn, $budgetId, $projectId, $phaseId, $taskId, $year) {
	$query = "select 
		sum(invl.priceactual*invl.qtyinvoiced) as amount
	from c_projecttask pt left outer join c_invoiceline invl on pt.m_product_id = (case invl.bom_parent_id when null then invl.m_product_id else invl.bom_parent_id end)
		left outer join c_invoice inv on invl.c_invoice_id = inv.c_invoice_id
		inner join c_projectphase pp on pt.c_projectphase_id = pp.c_projectphase_id
		inner join pjt_phasegroup ppg on pp.em_pjt_phasegroup_id = ppg.pjt_phasegroup_id
		inner join c_budgetline cbl on cbl.em_bgt_c_projecttask_id = pt.c_projecttask_id
		inner join c_budget cb on cbl.c_budget_id = cb.c_budget_id
		 inner join c_project cp on cp.c_project_id = pp.c_project_id
	where cbl.c_budget_id = '$budgetId' and pp.c_project_id = '$projectId' and pp.c_projectphase_id = '$phaseId' and pt.c_projecttask_id = '$taskId' and date_part('year', inv.dateinvoiced ) = '$year';";
	$result = pg_exec($dbconn, $query);
	$row = pg_fetch_array($result);
	if (!isset($row)) {
		return '0';
	}
	if (!isset($row['amount'])) {
		return '0';
	}
	return $row['amount'];
}

function getBudgetValue($dbconn, $budgetId, $projectId, $phaseId, $taskId) {
	$query = "select amount from c_budgetline cbl
				where  c_budget_id  $budgetId and c_project_id = '$projectId' and em_bgt_c_projectphase_id = '$phaseId' and em_bgt_c_projecttask_id = '$taskId' ";
	$result = pg_exec($dbconn, $query);
	$row = pg_fetch_array($result);
	if (!isset($row)) {
		return '0';
	}
	if (!isset($row['amount'])) {
		return '0';
	}
	return $row['amount'];
}

function getBudgetValueUSD($dbconn, $budgetId, $projectId, $phaseId, $taskId) {
	$query = "select c_currency_convert(amount, '303','100',c_period.startdate, null, '*') as amount_usd from c_budgetline cbl
				where  c_budget_id  $budgetId and c_project_id = '$projectId' and em_bgt_c_projectphase_id = '$phaseId' and em_bgt_c_projecttask_id = '$taskId' ";
	$result = pg_exec($dbconn, $query);
	$row = pg_fetch_array($result);
	if (!isset($row)) {
		return '0';
	}
	if (!isset($row['amount'])) {
		return '0';
	}
	return $row['amount'];
}
