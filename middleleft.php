<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi budget vs cost table
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @author     Winda Prihatin <winda@wiradipa.com>
	 * @version    1.0
	 */
	 
	include "dbcon.php";
	
	$budget = $_GET['budget'];

	if(isset($_GET['budget'])){
		$result = pg_exec($dbconn, "select phase_name,
			sum(case when c_budget_id = '$budget' then b_amount else 0 end) as budget,
			sum(case when c_budget_id = '$budget' and tahun = '2013' then c_amount else 0 end) as thn2013,
			sum(case when c_budget_id = '$budget' and tahun = '2014' then c_amount else 0 end) as thn2014,
			sum(case when c_budget_id = '$budget' and tahun = '2015' then c_amount else 0 end) as thn2015
			from (select c_project.name||' - '||c_projectphase.name as phase_name, 
					sum(c_budgetline.amount) as b_amount, c_budget.name, c_budget.c_budget_id, 
					to_char(m_costing.created, 'YYYY') as tahun, sum(m_costing.price) as c_amount
					from c_project
					left outer join c_projectphase on c_projectphase.c_project_id = c_project.c_project_id
					left outer join m_product on m_product.m_product_id = c_projectphase.m_product_id
					left outer join c_budgetline on c_budgetline.m_product_id = c_projectphase.m_product_id
					left outer join c_budget on c_budgetline.c_budget_id = c_budget.c_budget_id
					left outer join m_costing on m_costing.m_product_id = m_product.m_product_id
					group by c_projectphase.name, c_budget.name, c_project.name, c_budget.c_budget_id, m_costing.created
					order by c_project.name asc) as foo
			group by phase_name
			order by phase_name");
	} else { //jika $_GET['budget'] tidak terdefinisi
		$result = pg_exec($dbconn, "select phase_name,
			sum(b_amount) as budget,
			sum(case when tahun = '2013' then c_amount else 0 end) as thn2013,
			sum(case when tahun = '2014' then c_amount else 0 end) as thn2014,
			sum(case when tahun = '2015' then c_amount else 0 end) as thn2015
			from (select c_project.name||' - '||c_projectphase.name as phase_name, 
					sum(c_budgetline.amount) as b_amount, c_budget.name, c_budget.c_budget_id, 
					to_char(m_costing.created, 'YYYY') as tahun, sum(m_costing.price) as c_amount
					from c_project
					left outer join c_projectphase on c_projectphase.c_project_id = c_project.c_project_id
					left outer join m_product on m_product.m_product_id = c_projectphase.m_product_id
					left outer join c_budgetline on c_budgetline.m_product_id = c_projectphase.m_product_id
					left outer join c_budget on c_budgetline.c_budget_id = c_budget.c_budget_id
					left outer join m_costing on m_costing.m_product_id = m_product.m_product_id
					group by c_projectphase.name, c_budget.name, c_project.name, c_budget.c_budget_id, m_costing.created
					order by c_project.name asc) as foo
			group by phase_name
			order by phase_name");
	}


  	$numrows = pg_numrows($result); 

	$data = array(); 

    while($row = pg_fetch_array($result)) {
    	if ($row["phase_name"] != ''){ //$row["phase_name"] harus ada nilainya
	    	$phase_name = $row["phase_name"];
		   
		   $budget = new stdClass;
		   $budget->v = (int)$row["budget"];
		   $budget->f = ($row["budget"] == '') ? '0' : $row["budget"];
		   
		   $thn2013 = new stdClass;
		   $thn2013->v = (int)$row["thn2013"];
		   $thn2013->f = "".round((float)$row["thn2013"], 2);
		   
		   $thn2014 = new stdClass;
		   $thn2014->v = (int)$row["thn2014"];
		   $thn2014->f = "".round((float)$row["thn2014"], 2);
		   
		   $thn2015 = new stdClass;
		   $thn2015->v = (int)$row["thn2015"];
		   $thn2015->f = "".round((float)$row["thn2015"], 2);

		   $sisa = (int)$row["budget"] - ((int)$row["thn2013"]+(int)$row["thn2014"]+(int)$row["thn2015"]);
		   $persen = $sisa/(int)$row["budget"] * 100;
		   $persen = round($persen, 2);
		   $row_s = new stdClass;
		   $row_s->v = $persen;
		   $row_s->f = "$persen %";

		   $data[] = array($phase_name,$budget,$thn2013,$thn2014,$thn2015,$row_s);
		}
	}  
	// free memory
	pg_free_result($result);
	// close connection
	pg_close($dbconn);
	
	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>