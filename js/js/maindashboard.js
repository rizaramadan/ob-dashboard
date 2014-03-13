        /* var init */
        var topleft_progress = new Array();
        var topleft_budget = new Array();
        var topleft_payment_plan = new Array();
        var topleft_x = new Array();
		
		var ganttFirstRun = true;

        var globalproject_id;
        var projecttopleft;
        var budgetTopLeft;
		var rows_mid;
		var globalyear = new Date().getFullYear();

        var topright_totalbudget = new Array();
        var topright_budgetplan = new Array();
        var topright_totalpayment = new Array();
        var topright_paymentplan = new Array();
        var topright_x = new Array();
		
		
		

        var budgetTopRight;
        var budgetMiddleLeft;
        var budgetBottomLeft1;
        var budgetBottomRight2;
        /* var init */
      
				/*alert("bro");
				data10 = [
				{
				  "firstname": "John",
				  "lastname": "Smith",
				  "age": 15,
				  "class": "B10",
				  "courses": [
					{
					  "course": "physics", 
					  "grade": "B", 
					  "tests": [
						{"test": "test 1", "grade": "A"},
						{"test": "test 2", "grade": "B"},
						{"test": "final exam", "grade": "B"}
					  ]
					},
					{"course": "maths", "grade": "C"},
					{"course": "economy", "grade": "B"}
				  ]
				},
				{
				  "firstname": "Susan",
				  "lastname": "Brown",
				  "age": 16,
				  "class": "B10"
				},
				{
				  "firstname": "David",
				  "lastname": "Harris",
				  "age": 14,
				  "class": "B10",
				  "courses": [
					{"course": "economy", "grade": "A"},
					{"course": "maths", "grade": "D"}
				  ]           
				}
				];

				// specify options
				var options10 = {
				'width': '500px',
				'height': '400px'
				};  

				// Instantiate our treegrid object.
				var container10 = document.getElementById('bottom-right');
				treegrid = new links.TreeGrid(container10, options10);

				data10 = new links.DataTable(data10);

				// Draw our treegrid with the created data and options 
				treegrid.draw(data10); */
	  
	  
        /* retrieve data */
        /* ------------------------------------------------------------------------------- -------------------------------------------------------------------------------*/
		
        $.getJSON('http://localhost/ob/BudgetProgressPaymentplan.php?callback=?&year=' +globalyear,function(result){
            for (var i in result['databudget']){
                topleft_budget.push(result['databudget'][i]);
            };
            for (var i in result['datax']){
                topleft_x.push(result['datax'][i]);
            };
            for (var i in result['progress']){
                topleft_progress.push(result['progress'][i]);
            };
            for (var i in result['payment_plan']){
                topleft_payment_plan.push(result['payment_plan'][i]);
            };
        });


        $.getJSON("http://localhost/ob/BudgetCashflow.php?callback=?&year=" +globalyear,function(result){
            for (var i in result['totalbudget']){
                topright_totalbudget.push(result['totalbudget'][i]);
            };
            for (var i in result['budgetplan']){
                topright_budgetplan.push(result['budgetplan'][i]);
            };
            for (var i in result['totalpayment']){
                topright_totalpayment.push(result['totalpayment'][i]);
            };
            for (var i in result['paymentplan']){
                topright_paymentplan.push(result['paymentplan'][i]);
            };
            for (var i in result['datax']){
                topright_x.push(result['datax'][i]);
            };
        });

        refreshBudgetSelectionOption();

        $.getJSON("http://localhost/ob/getproject.php?callback=?",function(j){
            var options = '';
            options += '<option value="">All Project </option>';
            for (var i = 0; i < j.length; i++) {
                options += '<option value="' + j[i].c_project_id + '">' + j[i].name + '</option>';
            }
            $("select#optProjectTopLeft").html(options);
            $("select#globalproject").html(options);
            projecttopleft = $("#optProjectTopLeft" ).val();
        });
		
		 $.getJSON("http://localhost/ob/getyear.php?callback=?",function(j){
            var options = '';
			var currentYear = new Date().getFullYear();
            options += '<option value="">All Year </option>';
            for (var i = 0; i < j.length; i++) {
				if (currentYear == j[i].year) {
					options += '<option value="' + j[i].year + '" selected>' + j[i].year + '</option>';
				} else {
					options += '<option value="' + j[i].year + '">' + j[i].year + '</option>';
				}
            }
            $("select#globalyear").html(options);
            globalyear = $("#globalyear" ).val();
			
			
        });
		
		
		var treegrid;
		var data;
		
		$.getJSON("http://localhost/ob/BudgetCost.php?callback=?",function(result){
			data = result;
						
			// specify options
			var options = {
			  'width': '100%',
			  'height': '400px'
			};  

			// Instantiate our treegrid object.
			var container = document.getElementById('bottom-right');
			treegrid = new links.TreeGrid(container, options);

			data = new links.DataTable(data);

			// Draw our treegrid with the created data and options 
			treegrid.draw(data);   
			 
		 });
        /* retrieve data */
        
		var colorTotalPaymentplan = "blue";
		var colorPaymentplan = "#8080ff";
		var colorTotalBudget = "#ed2b50";
		var colorBudget= "#fd3b60";
		var colorTotalProgress= "#81c64d";
		
        /* func init */
        function topleft() {
            $('#top-left').highcharts({
                 colors: [
                   colorTotalProgress,//'#4572A7', 
                   colorTotalBudget,
                   colorTotalPaymentplan//'#DB843D', 
                   //'#AA4643', 
                   //'#89A54E', 
                   //'#80699B', 
                   //'#3D96AE', 
                   //'#92A8CD', 
                   //'#A47D7C' 
                ],
                chart: {
                    zoomType: 'xy'
                },
                credits: {
                      enabled: false
                  },
                title: {
                    text: 'Grafik Budget, Progress & Jadwal Pembayaran'
                },
                subtitle: {
                    text: 'berisikan perbandingan data budget, progress proyek and jadwal pembayaran'
                },
                xAxis: [{                    
                    categories: topleft_x
                }],
                yAxis: [{ // Primary yAxis
                    labels: {
                        formatter: function() {
                            return this.value +'%';
                        },
                        style: {
                            color: '#89A54E'
                        }
                    },
                    title: {
                        text: 'Persentase',
                        style: {
                            color: '#89A54E'
                        }
                    },
                    opposite: false
        
                }],
                tooltip: {
                    shared: true
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    x: 120,
                    verticalAlign: 'top',
                    y: 80,
                    floating: true,
                    backgroundColor: '#dedede'
                },
                series: [{
                    name: 'Progress',
                    //color: '#AA4643',
                    type: 'column',
                    yAxis: 0,
                    index: 2,
                    data:topleft_progress,
                    tooltip: {
                        valueSuffix: ' %'
                    }
        
                }, {
                    name: 'Budget',
                    type: 'spline',
                    dataLabels: { enabled: true },
                    //color: '#95D2F7',
                    yAxis: 0,
                    index: 1,
                    data:topleft_budget,
                    marker: {
                        enabled: false
                    },
                   tooltip: {
                        valueSuffix: ' %'
                    }
        
                }, {
                    name: 'Payment Plan',
                    //color: '#89A54E',
                    type: 'spline',
                    index: 3,
                    data: topleft_payment_plan,
                    tooltip: {
                        valueSuffix: ' %'
                    }
                }]
            });
        }

        function toprightGraph(){
            $('#top-right').highcharts({
                colors: [
                   colorTotalBudget,//'#4572A7', 
                   colorBudget,//'#80699B', 
                   colorTotalPaymentplan,// '#89A54E', 
                   colorPaymentplan//'#DB843D', 
                   //'#92A8CD', 
                   //'#3D96AE',
                   //'#AA4643', 
                   //'#A47D7C', 
                   //'#B5CA92'
                ],
                plotOptions: {
                    column: {
                        pointPadding: 0.01,
                        borderWidth: 0
                    }
                },
                chart: {
                    zoomType: 'xy'
                },
                credits: {
                      enabled: false
                  },
                title: {
                    text: 'Grafik Budget dan Aliran Dana'
                },
                subtitle: {
                    text: 'menampilkan data aliran budget dan aliran dana '
                },
                xAxis: [{
                    categories: topright_x
                }],
                yAxis: [{ // Primary yAxis
                    labels: {
                        formatter: function() {
                            return 'Rp. ' + this.value ;
                        },
                        style: {
                            color: '#89A54E'
                        }
                    },
                    title: {
                        text: 'Rupiah',
                        style: {
                            color: '#89A54E'
                        }
                    },
                    opposite: false
        
                }],
                tooltip: {
                    shared: true
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    x: 120,
                    verticalAlign: 'top',
                    y: 80,
                    floating: true,
                    backgroundColor: '#dedede'
                },                
                series: [{
                    name: 'Total Budget',
                    type: 'spline',
                    yAxis: 0,
                    index: 2,
                    dashStyle: 'ShortDash',
                    marker: {
                        enabled: false
                    },
                    data: topright_totalbudget,
                    tooltip: {
                        //valueSuffix: ' Billion',
                        valuePrefix: 'Rp. '
                    }
        
                }, {
                    name: 'Rencana Budget',
                    type: 'column',
                    dataLabels: {
                        enabled: true
                    },
                    yAxis: 0,
                    index: 1,
                    data: topright_budgetplan,
                    
                    tooltip: {
                        //valueSuffix: ' Billion',
                        valuePrefix: 'Rp. '
                    }
        
                }, {
                    name: 'Total Pembayaran',
                    type: 'spline',
                    index: 3,
                    dashStyle: 'ShortDash',
                    marker: {
                        enabled: false
                    },
                    data: topright_totalpayment,
                    tooltip: {
                        //valueSuffix: ' Billion',
                        valuePrefix: 'Rp. '
                    }
                } , {
                    name: 'Jadwal Pembayaran',
                    type: 'column',
                    dataLabels: {
                        enabled: true
                    },
                    yAxis: 0,
                    index: 1,
                    data: topright_paymentplan,
                    marker: {
                        enabled: false
                    },
                    tooltip: {
                        //valueSuffix: ' Billion',
                        valuePrefix: 'Rp. '
                    }
        
                }]
            });
        }
        /* func init */

            /* call */
            $(function () {
                topleft();
                toprightGraph();
				refreshBudgetCost();
				refreshBudgetGrossNett();
            });
            /* call */

            /* select */
            $("#optBudgetTopLeft" ).change(function() {
              budgetTopLeft = $(this).val();
            });

            $("#optProjectTopLeft" ).change(function() {
              projecttopleft = $(this).val();
            });

            $("#optBudgetTopRight" ).change(function() {
              budgetTopRight = $(this).val();
            });

            $("#globalproject").change(function() {
                globalproject_id = $(this).val();
				refreshBudgetSelectionOption();
            });
			
			$("#globalyear").change(function() {
                globalyear = $(this).val();
				refreshBudgetSelectionOption();
            });
            /* select */
            
            /* button select budget of graph budget progress payment*/
            

            /* button */

            refreshGantt();
            
            
            /* gantt chart */


            /* middleleft */
           

            $("#budgetMiddleLeft" ).change(function() {
              budgetMiddleLeft = $(this).val();
            });
            /* middleleft */
			$("#budgetMiddleLeft" ).change(function() {
              budgetMiddleLeft = $(this).val();
            });
			
			$("#budgetBottomRight1" ).change(function() {
              budgetBottomRight1 = $(this).val();
            });
			
			$("#budgetBottomRight2" ).change(function() {
              budgetBottomRight2 = $(this).val();
            });
            
			/* bottomleft */
			var rows_bottom = new Array();
			
			 
			var rows_bottommost = new Array();
			$.getJSON("http://localhost/ob/BudgetGrossNett.php?callback=?",function(result){
				 for (var i in result){
					var rows2 = [];
					rows2[0] = result[i][0];
					rows2[1] = result[i][1];
					rows2[2] = result[i][2];
					rows2[3] = result[i][3];
					rows_bottommost.push(rows2);
				 };
			 });

			google.load('visualization', '1', {packages:['table']});
			google.setOnLoadCallback(drawTable2);
			//google.setOnLoadCallback(drawTable3);
			
			function drawTable2(){
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'Phase');
				data.addColumn('number', 'Budget A');
				data.addColumn('number', 'Budget B');
				data.addColumn('number', 'Variance');
				data.addRows(rows_bottom);

				//var table = new google.visualization.Table(document.getElementById('bottom-right2'));
				//table.draw(data, {showRowNumber: true});
			}
			
			 
			function drawTable3(){
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'Name');
				data.addColumn('number', 'Amount');
				data.addColumn('number', 'Gross');
				data.addColumn('number', 'Nett');
				data.addRows(rows_bottommost);

				var table = new google.visualization.Table(document.getElementById('bottom-most'));
				//table.draw(data, {showRowNumber: true});
			}

			
			
			///---------------------------------------------------------------------------------------------------------------------------------------------
			/// BUTTON ACTIONS SECTION
			///---------------------------------------------------------------------------------------------------------------------------------------------
			$("#btnGlobalProject").click(function(){
				refreshBudgetSelectionOption();
				globalproject_id;
				//refreshGantt();
				globalproject_id;
				
				
				budgetTopLeft;
				refreshBudgetProgressPaymentplan();
				budgetMiddleLeft;
				refreshBudgetCost();
				budgetTopRight;
				refreshBudgetCashflow();
				budgetBottomRight1; budgetBottomRight2;
				//alert("b. budget bottom right1 :"+budgetBottomRight1+", right 2:"+budgetBottomRight2);
				refreshBudgetComparison();
				refreshBudgetGrossNett();
				
            });
			
			
			$("#btnGlobalYear").click(function(){
				refreshBudgetSelectionOption();
				globalproject_id;
				//refreshGantt();
				globalproject_id;
				
				
				budgetTopLeft;
				refreshBudgetProgressPaymentplan();
				budgetMiddleLeft;
				refreshBudgetCost();
				budgetTopRight;
				refreshBudgetCashflow();
				budgetBottomRight1; budgetBottomRight2;
				//alert("b. budget bottom right1 :"+budgetBottomRight1+", right 2:"+budgetBottomRight2);
				refreshBudgetComparison();
				
            });
			
			$("#btnTopLeftBudget").click(function(){
                refreshBudgetProgressPaymentplan();
            });
			
			 $("#btnMiddleLeft").click(function(){
                refreshBudgetCost();
            });

            $("#btnTopRight").click(function(){
                refreshBudgetCashflow();
            });
			
			$("#btnBottomLeft").click(function(){
				refreshBudgetComparison();
			});
			
			///---------------------------------------------------------------------------------------------------------------------------------------------
			/// FUNCTIONS SECTION
			///---------------------------------------------------------------------------------------------------------------------------------------------
			function refreshBudgetProgressPaymentplan() {
				topleft_progress.length = 0;
                topleft_budget.length = 0;
                topleft_x.length = 0;
                topleft_payment_plan.length = 0;

                $.getJSON('http://localhost/ob/BudgetProgressPaymentplan.php?callback=?','project='+globalproject_id+'&budget=' +budgetTopLeft+'&year=' +globalyear,function(result){
                    for (var i in result['databudget']){
                        topleft_budget.push(result['databudget'][i]);
                    };
                    for (var i in result['datax']){
                        topleft_x.push(result['datax'][i]);
                    };
                    for (var i in result['progress']){
                        topleft_progress.push(result['progress'][i]);
                    };
                    for (var i in result['payment_plan']){
                        topleft_payment_plan.push(result['payment_plan'][i]);
                    };
                    topleft();
                });
				
			}
			
			
			
			function refreshBudgetCost() {
				//rows_mid.length = 0;
                /*$.getJSON('http://localhost/ob/BudgetCost.php?callback=?','budget='+budgetMiddleLeft+'&project=' +globalproject_id, function(result) {
                    //rows_mid = result;
					//alert(result);
					alert("bro");
					// Instantiate our treegrid object.
					//var container = document.getElementById('bottom-right');
					//container.innerHTML = rows_mid;
					$('#bottom-right').html(result);
                }); */
				/*
				$.ajax({
					url: "http://localhost/ob/BudgetCost2.php",
					data: {
						budget: budgetMiddleLeft,
						project: globalproject_id
					},
					type: "GET",
					dataType: "html",
					success: function (data) {
						$('#bottom-right').html(data);
					},
					error: function (xhr, status) {
						alert("Sorry, there was a problem!");
					},
					complete: function (xhr, status) {
						//$('#showresults').slideDown('slow')
					}
				});
				*/
				
				$.getJSON("http://localhost/ob/BudgetCost.php?callback=?",function(result){
				data = result;
							
				// specify options
				var options = {
				  'width': '100%',
				  'height': '400px'
				};  

				// Instantiate our treegrid object.
				var container = document.getElementById('bottom-right');
				treegrid = new links.TreeGrid(container, options);

				data = new links.DataTable(data);

				// Draw our treegrid with the created data and options 
				treegrid.draw(data);   
				 
			 });
				
			}
			
			function refreshBudgetCashflow() {
				topright_totalbudget.length = 0;
                topright_budgetplan.length = 0;
                topright_totalpayment.length = 0;
                topright_paymentplan.length = 0;
                topright_x.length = 0;

                $.getJSON("http://localhost/ob/BudgetCashflow.php?callback=?",'budget='+budgetTopRight+'&year=' +globalyear,function(result){
                    for (var i in result['totalbudget']){
                        topright_totalbudget.push(result['totalbudget'][i]);
                    };
                    for (var i in result['budgetplan']){
                        topright_budgetplan.push(result['budgetplan'][i]);
                    };
                    for (var i in result['totalpayment']){
                        topright_totalpayment.push(result['totalpayment'][i]);
                    };
                    for (var i in result['paymentplan']){
                        topright_paymentplan.push(result['paymentplan'][i]);
                    };
                    for (var i in result['datax']){
                        topright_x.push(result['datax'][i]);
                    };
                    toprightGraph();
                });
				
			}
			
			function refreshBudgetComparison() {
				rows_bottom.length = 0;
				/*$.getJSON("http://localhost/ob/BudgetComparison.php?callback=?","budget1="+budgetBottomRight1+"&budget2="+budgetBottomRight2,function(result){
					 for (var i in result){
						var rows2 = [];
						rows2[0] = result[i][0];
						rows2[1] = result[i][1];
						rows2[2] = result[i][2];
						rows2[3] = result[i][3];
						rows_bottom.push(rows2);
					 };
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Phase');
					data.addColumn('number', result[i][4]);
					data.addColumn('number', result[i][5]);
					data.addColumn('number', 'Variance');
					data.addRows(rows_bottom);

					var table = new google.visualization.Table(document.getElementById('bottom-right2'));
					table.draw(data, {showRowNumber: true});
				});*/
				$.ajax({
					url: "http://localhost/ob/BudgetComparison.php",
					data: {
						budget1: budgetBottomRight1,
						budget2: budgetBottomRight2,
						project: globalproject_id
					},
					type: "GET",
					dataType: "html",
					success: function (data) {
						$('#bottom-right2').html(data);
					},
					error: function (xhr, status) {
						alert("Sorry, there was a problem!");
					},
					complete: function (xhr, status) {
						//$('#showresults').slideDown('slow')
					}
				});
			}
			
			function refreshBudgetGrossNett() {
				/*rows_bottommost.length = 0;
				$.getJSON("http://localhost/ob/BudgetGrossNett.php?callback=?",function(result){
					for (var i in result){
					   var rows2 = [];
					   rows2[0] = result[i][0];
					   rows2[1] = result[i][1];
					   rows2[2] = result[i][2];
					   rows2[3] = result[i][3];
					   rows_bottommost.push(rows2);
					};
				});
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'Name');
				data.addColumn('number', 'Amount');
				data.addColumn('number', 'Gross');
				data.addColumn('number', 'Nett');
				data.addRows(rows_bottommost);

				var table = new google.visualization.Table(document.getElementById('bottom-most'));
				table.draw(data, {showRowNumber: true});*/
				$.ajax({
					url: "http://localhost/ob/BudgetGrossNett.php",
					type: "GET",
					dataType: "html",
					success: function (data) {
						$('#bottom-most').html(data);
					},
					error: function (xhr, status) {
						alert("recheck the ajax calling");
					},
					complete: function (xhr, status) {
						//$('#showresults').slideDown('slow')
					}
				});
				
			}
			
			function refreshGantt() {
				
				if(globalproject_id === null || globalproject_id === 'undefined' || ! globalproject_id) globalproject_id = "";
                 $.getJSON("http://localhost/ob/gantt.php?callback=?","project="+globalproject_id+'&year=' +globalyear,function(result) {    
					if(ganttFirstRun) {
						gantt.config.scale_unit = "year";
						gantt.config.step = 1;
						gantt.config.date_scale = "%Y";
						gantt.config.min_column_width = 35;

						gantt.config.scale_height = 90;

						var monthScaleTemplate = function(date){
							var dateToStr = gantt.date.date_to_str("%m");
							var endDate = gantt.date.add(date, 2, "month");
							return dateToStr(date) + " - " + dateToStr(endDate);
						};

						gantt.config.subscales = [
							{unit:"month", step:3, template:monthScaleTemplate},
							{unit:"month", step:1, date:"%m" }
						];

						gantt.init("gantt_here");
						gantt.parse(result);
					} else {
						
						gantt.parse(result);
					}
				});
			}
			
			function refreshBudgetSelectionOption() {
				$.getJSON("http://localhost/ob/getbudget.php?callback=?","&project="+globalproject_id,function(j) {
					var options = '';
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].c_budget_id + '">' + j[i].name + '</option>';
					}
					$("select#optBudgetTopLeft").html(options);
					$("select#optBudgetTopRight").html(options);
					$("select#budgetMiddleLeft").html(options);
					$("select#budgetBottomRight1").html(options);
					var options = '';
					if(j.length > 1) {
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].c_budget_id + '">' + j[i].name + '</option>';
						}
					}
					$("select#budgetBottomRight2").html(options);
					
					budgetTopLeft = $("#optBudgetTopLeft" ).val();
					budgetTopRight = $("#optBudgetTopRight" ).val();
					budgetMiddleLeft = $("#budgetMiddleLeft" ).val();
					budgetBottomRight1 = $("#budgetBottomRight1" ).val();
					budgetBottomRight2 = $("#budgetBottomRight2" ).val();
					//alert("a. budget bottom right1 :"+budgetBottomRight1+", right 2:"+budgetBottomRight2);
				});
			}
			