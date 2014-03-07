<?php

	/**
	 * File yang berfungsi untuk menyediakan data bagi budget comparison
	 *
	 * @author     Helmi Agustian <helmi.agustian@wiradipa.com>
	 * @author     Winda Prihatin <winda@wiradipa.com>
	 * @version    1.0
	 */

	include "dbcon.php";	

	if(isset($_GET['budget1'])){
			//ketika $_GET['budget1'] ada nilainya
			$budget1 = $_GET['budget1'];
			$budget2 = $_GET['budget2'];
		}else{
			//ketika $_GET['budget1'] tidak ada nilainya, $budget1 dan $budget2 disi nilai default
			$result_c_budget = pg_exec($dbconn,"select * from c_budget order by created desc limit 1");
			$row_c_budget = pg_fetch_array($result_c_budget);
			$budget1 = $row_c_budget['c_budget_id'];
			$budget2 = $row_c_budget['c_budget_id'];
	}

	$result = pg_exec($dbconn,"select phase_name,
		sum(case when c_budget_id = '$budget1' then amount else 0 end) as amount1,
		sum(case when c_budget_id = '$budget2' then amount else 0 end) as amount2
		from (select c_project.name||' - '||c_projectphase.name as phase_name, 
				sum(c_budgetline.amount) as amount, c_budget.name, c_budget.c_budget_id
				from c_project
					left outer join c_projectphase on c_projectphase.c_project_id = c_project.c_project_id
					left outer join m_product on m_product.m_product_id = c_projectphase.m_product_id
					left outer join c_budgetline on c_budgetline.m_product_id = c_projectphase.m_product_id
					left outer join c_budget on c_budgetline.c_budget_id = c_budget.c_budget_id
					left outer join m_costing on m_costing.m_product_id = m_product.m_product_id
				group by c_projectphase.name, c_budget.name, c_project.name, c_budget.c_budget_id
				order by c_project.name asc) as foo
		group by phase_name
		order by phase_name");

	$result1 = pg_exec($dbconn,"select name from c_budget where c_budget_id = '$budget1'");
	$row1 = pg_fetch_array($result1);
	$result2 = pg_exec($dbconn,"select name from c_budget where c_budget_id = '$budget2'");
	$row2 = pg_fetch_array($result2);

  	$numrows = pg_numrows($result); 
	$data = array(); 

    while($row = pg_fetch_array($result)) {
    	if($row["phase_name"] != '') {
	       	$data_name1 = $row["phase_name"]; 
		   
		   	$budget_1 = new stdClass;
		   	$budget_1->v = (int)$row["amount1"];
		   	$budget_1->f = $row["amount1"];

			$budget_2 = new stdClass;
		   	$budget_2->v = (int)$row["amount2"];
		   	$budget_2->f = $row["amount2"];

			$row_s = new stdClass;
			$int = ((int)$row["amount1"]/(int)$row["amount2"])*100;
			$row_s->v = $int;
			$row_s->f = "$int%";

			$head1 = $row1["name"];
			$head2 = $row2["name"];

		   $data[] = array($data_name1,$budget_1,$budget_2,$row_s,$head1,$head2);
		}
	}

	// free memory
	pg_free_result($result);
	// close connection
	pg_close($dbconn);

	echo $_GET['callback'] . '(' . json_encode($data) . ')';
?>