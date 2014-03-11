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
function getBudgetQuery ($project_id, $budget_id, $year) {
	global $firstyear;
	$retval = "select c_budgetline_id, c_budgetline.c_project_id as project_id, c_budgetline.em_bgt_c_projectphase_id as project_phase, c_budgetline.em_bgt_c_projecttask_id as project_task,
			c_budgetline.amount/1000 as amount, em_pjt_phasegroup_id, ppg.name, cp.name as projectName,
			c_currency_convert(amount/1000, '303','100',c_period.startdate, null, '*') as amount_usd, c_budgetline.c_budget_id as name ,c_budgetline.c_budget_id as budget,
			c_period.startdate as actualdate, date_part('year',c_period.startdate) as actualyear, c_period.name as period_name, c_budgetline.c_budget_id as budget_id, (date_part('year',c_period.startdate) -  ".$firstyear.") * 12 + date_part('month',c_period.startdate) as bulan
		from c_period left outer join c_budgetline on c_budgetline.c_period_id = c_period.c_period_id
		left outer join c_projectphase pp on c_budgetline.em_bgt_c_projectphase_id = pp.c_projectphase_id
		left outer join pjt_phasegroup ppg on ppg.pjt_phasegroup_id = pp.em_pjt_phasegroup_id
		left outer join c_project cp on pp.c_project_id = cp.c_project_id
		where c_period.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C' and c_budgetline.c_project_id ".$project_id."  and c_budgetline.c_budget_id  ".$budget_id." and date_part('year',c_period.startdate) ".$year." order by c_period.startdate;";
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
	$retval="
		select pjt_progresshistory.pjt_progresshistory_id,	pjt_progresshistory.progress_project as amount, 
		(date_part('year',pjt_progresshistory.created) - ".$firstyear.") * 12 + date_part('month',pjt_progresshistory.created) as bulan,
		to_char(pjt_progresshistory.created, 'dd') as tanggal,c_projectphase.c_project_id as project_id
		from pjt_progresshistory join c_projectphase on pjt_progresshistory.c_projectphase_id = c_projectphase.c_projectphase_id
		where c_projectphase.c_project_id ".$project_id."
		and date_part('year',pjt_progresshistory.created) ".$year." 
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
	$retval="
		select o.grandtotal*p.percentage/100 as amount, ((date_part('year',duedate) -  ".$firstyear.") * 12 + date_part('month',duedate))::integer as bulan 
				from por_payment_schedule p
				inner join c_order o on p.c_order_id = o.c_order_id
			where o.c_project_id ".$project_id."
			and date_part('year',duedate) ".$year." and p.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C'
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
			invl.c_project_id as project_id,pt.c_projectphase_id as project_phase,pt.c_projecttask_id as project_task,inv.dateinvoiced as actualdate, invl.priceactual*invl.qtyinvoiced as amount,
			c_currency_convert(invl.priceactual*invl.qtyinvoiced, '303','100',inv.dateinvoiced, null, '*') as amount_usd,
			(date_part('year',inv.dateinvoiced) - ".$firstyear.") * 12 + date_part('month',inv.dateinvoiced) as bulan
		from c_invoiceline invl
			inner join c_invoice inv on invl.c_invoice_id = inv.c_invoice_id
			inner join c_projecttask pt on pt.m_product_id = (case invl.bom_parent_id when null then invl.m_product_id else invl.bom_parent_id end)
		where  invl.c_project_id  ".$project_id."  and  inv.ispaid = 'Y' inv.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C' order by inv.dateinvoiced ";
	return $retval;
	
}

function getBudgetVsCostQuery($project_id, $budget_id) {
	$retval = "select cb.name as budget_name, cbl.c_budget_id, 
			cp.name as project_name,pp.c_project_id,	
			ppg.name as group_name, pp.em_pjt_phasegroup_id, 
			pp.name as phase_name, pp.c_projectphase_id,	
			pt.name as task_name, pt.c_projecttask_id as project_task, 
			invl.priceactual*invl.qtyinvoiced as amount,c_currency_convert(invl.priceactual*invl.qtyinvoiced, '303','100',inv.dateinvoiced, null, '*') as amount_usd, 
			cbl.amount as amountbudget, date_part('year', inv.dateinvoiced ) as actualyear
		from c_projecttask pt left outer join c_invoiceline invl on pt.m_product_id = (case invl.bom_parent_id when null then invl.m_product_id else invl.bom_parent_id end)
			left outer join c_invoice inv on invl.c_invoice_id = inv.c_invoice_id
			inner join c_projectphase pp on pt.c_projectphase_id = pp.c_projectphase_id
			inner join pjt_phasegroup ppg on pp.em_pjt_phasegroup_id = ppg.pjt_phasegroup_id
			inner join c_budgetline cbl on cbl.em_bgt_c_projecttask_id = pt.c_projecttask_id
			inner join c_budget cb on cbl.c_budget_id = cb.c_budget_id
			 inner join c_project cp on cp.c_project_id = pp.c_project_id
		where pp.c_project_id ".$project_id." and cb.c_budget_id ".$budget_id." and (inv.ispaid = 'Y' or inv.ispaid is null) and inv.docstatus <> 'VO' order by budget_name, project_name, group_name desc, phase_name, task_name;";
		$retval = "select cb.name as budget_name, cbl.c_budget_id, 
			cp.name as project_name,pp.c_project_id,	
			cp.name as group_name, pp.em_pjt_phasegroup_id, 
			pp.name as phase_name, pp.c_projectphase_id,	
			pt.name as task_name, pt.c_projecttask_id as project_task, 
			invl.priceactual*invl.qtyinvoiced as amount,c_currency_convert(invl.priceactual*invl.qtyinvoiced, '303','100',inv.dateinvoiced, null, '*') as amount_usd, 
			cbl.amount as amountbudget, date_part('year', inv.dateinvoiced ) as actualyear
		from c_projecttask pt left outer join c_invoiceline invl on pt.m_product_id = (case invl.bom_parent_id when null then invl.m_product_id else invl.bom_parent_id end)
			left outer join c_invoice inv on invl.c_invoice_id = inv.c_invoice_id
			inner join c_projectphase pp on pt.c_projectphase_id = pp.c_projectphase_id
			inner join c_budgetline cbl on cbl.em_bgt_c_projecttask_id = pt.c_projecttask_id
			inner join c_budget cb on cbl.c_budget_id = cb.c_budget_id
			 inner join c_project cp on cp.c_project_id = pp.c_project_id
		where pp.c_project_id ".$project_id." and cb.c_budget_id ".$budget_id." cb.ad_client_id = '142F2095A9FE48ECB13CD19A06A0BD9C' order by budget_name, project_name, group_name desc, phase_name, task_name;";
	return $retval;
}

function getBudgetBuildingQuery() {
	$retval = "select b.name as budgetname, (select sum(amount) from c_budgetline where c_budget_id = b.c_budget_id)as amount, 
		b.em_bgt_constructionarea as gross,
		b.em_bgt_rentarea as nett
		from c_budget b
		group by b.name, b.c_budget_id, b.em_bgt_constructionarea, b.em_bgt_rentarea;";
	return $retval;
}