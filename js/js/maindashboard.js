        var topleft_progress = new Array();
        var topleft_budget = new Array();
        var topleft_payment_plan = new Array();
        var topleft_x = new Array();

        var globalproject;
        var projecttopleft;
        var budgetTopLeft;

        var topright_totalbudget = new Array();
        var topright_budgetplan = new Array();
        var topright_totalpayment = new Array();
        var topright_paymentplan = new Array();
        var topright_x = new Array();

        var budgetTopRight;
        var budgetMiddleLeft;
        var budgetBottomLeft1;
        var budgetBottomRight2



        $.getJSON('http://localhost/ob/topleft.php?callback=?',function(result){
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


        $.getJSON("http://localhost/ob/topright.php?callback=?",function(result){
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

            var demo_tasks;
            $.getJSON("http://localhost/ob/gantt.php?callback=?",function(result){              
                demo_tasks = result;
            });

        function topleft(){
            $('#top-left').highcharts({
                 colors: [
                   '#4572A7', 
                   '#B5CA92',
                   '#DB843D', 
                   '#AA4643', 
                   '#89A54E', 
                   '#80699B', 
                   '#3D96AE', 
                   '#92A8CD', 
                   '#A47D7C' 
                ],
                chart: {
                    zoomType: 'xy'
                },
                title: {
                    text: 'Graph of Budget, Progress & Payment'
                },
                subtitle: {
                    text: 'contains data about budget, projects progress and projects payments'
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
                    type: 'spline',
                    yAxis: 0,
                    index: 2,
                    data:topleft_progress,
                    tooltip: {
                        valueSuffix: ' %'
                    }
        
                }, {
                    name: 'Budget',
                    type: 'column',
                    dataLabels: { enabled: true },
                    //color: '#95D2F7',
                    yAxis: 0,
                    index: 1,
                    data:topleft_budget,
                    marker: {
                        enabled: false
                    },
                    dashStyle: 'shortdot',
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
                   '#4572A7', 
                   '#80699B', 
                   '#89A54E', 
                   '#DB843D', 
                   '#92A8CD', 
                   '#3D96AE',
                   '#AA4643', 
                   '#A47D7C', 
                   '#B5CA92'
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
                title: {
                    text: 'Graph of Budget and Cashflow'
                },
                subtitle: {
                    text: 'contains data about budget and cashflow '
                },
                xAxis: [{
                    categories: topright_x
                }],
                yAxis: [{ // Primary yAxis
                    labels: {
                        formatter: function() {
                            return 'Rp. ' + this.value + ' (Billion)';
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
                        valueSuffix: ' Billion',
                        valuePrefix: 'Rp. '
                    }
        
                }, {
                    name: 'Budget Plan',
                    type: 'column',
                    dataLabels: {
                        enabled: true
                    },
                    yAxis: 0,
                    index: 1,
                    data: topright_budgetplan,
                    
                    tooltip: {
                        valueSuffix: ' Billion',
                        valuePrefix: 'Rp. '
                    }
        
                }, {
                    name: 'Total Payment',
                    type: 'spline',
                    index: 3,
                    dashStyle: 'ShortDash',
                    marker: {
                        enabled: false
                    },
                    data: topright_totalpayment,
                    tooltip: {
                        valueSuffix: ' Billion',
                        valuePrefix: 'Rp. '
                    }
                } , {
                    name: 'Payment Plan',
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
                        valueSuffix: ' Billion',
                        valuePrefix: 'Rp. '
                    }
        
                }]
            });
        }

        $(function () {
            topleft();
            toprightGraph();
        });


         var rows_mid = new Array();
            $.getJSON('http://localhost/ob/middleleft.php?callback=?',function(result){
                for (var i in result){
                    var rows1 = [];
                    rows1[0] = result[i][0];
                    rows1[1] = result[i][1]; 
                    rows1[2] = result[i][2]; 
                    rows1[3] = result[i][3]; 
                    rows1[4] = result[i][4]; 
                    rows1[5] = result[i][5]; 
                    rows_mid.push(rows1);
                };
            }); 

            google.load('visualization', '1', {packages:['table']});
            google.setOnLoadCallback(drawTable1);
            function drawTable1() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Phase');
                data.addColumn('number', 'Budget 1');
                data.addColumn('number', '2013');
                data.addColumn('number', '2014');
                data.addColumn('number', '2015');
                data.addColumn('number', 'Balance');
                data.addRows(rows_mid);

                var table = new google.visualization.Table(document.getElementById('bottom-right'));
                table.draw(data, {showRowNumber: true});
            }
            
                var rows_bottom = new Array();
                $.getJSON("http://localhost/ob/bottomleft.php?callback=?",function(result){
                     for (var i in result){
                        var rows2 = [];
                        rows2[0] = result[i][0];
                        rows2[1] = result[i][1];
                        rows2[2] = result[i][2];
                        rows2[3] = result[i][3];
                        rows_bottom.push(rows2);
                     };
                 });


                google.load('visualization', '1', {packages:['table']});
                google.setOnLoadCallback(drawTable2);
                function drawTable2(){
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Phase');
                    data.addColumn('number', 'Budget A');
                    data.addColumn('number', 'Budget B');
                    data.addColumn('number', 'Variance');
                    data.addRows(rows_bottom);

                    var table = new google.visualization.Table(document.getElementById('bottom-right2'));
                    table.draw(data, {showRowNumber: true});
                }



                /**/

                $.getJSON("http://localhost/ob/getbudget.php?callback=?",function(j){
                var options = '';
                options += '<option value="">All</option>';
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].c_budget_id + '">' + j[i].name + '</option>';
                }
                $("select#optBudgetTopLeft").html(options);

                var options = '';
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].c_budget_id + '">' + j[i].name + '</option>';
                }

                $("select#optBudgetTopRight").html(options);
                $("select#budgetMiddleLeft").html(options);
                $("select#budgetBottomRight1").html(options);
                $("select#budgetBottomRight2").html(options);
                budgetTopLeft = $("#optBudgetTopLeft" ).val();
                budgetTopRight = $("#optBudgetTopRight" ).val();
                budgetMiddleLeft = $("#budgetMiddleLeft" ).val();
                budgetBottomRight1 = $("#budgetBottomRight1" ).val();
                budgetBottomRight2 = $("#budgetBottomRight2" ).val();
            });

            $.getJSON("http://localhost/ob/getproject.php?callback=?",function(j){
                var options = '';
                options += '<option value="">All Project</option>';
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].c_project_id + '">' + j[i].name + '</option>';
                }
                $("select#optProjectTopLeft").html(options);
                $("select#globalproject").html(options);
                projecttopleft = $("#optProjectTopLeft" ).val();
            });

            $("#btnTopLeftBudget").click(function(){
                topleft_progress.length = 0;
                topleft_budget.length = 0;
                topleft_x.length = 0;
                topleft_payment_plan.length = 0;

                $.getJSON('http://localhost/ob/topleft.php?callback=?','project='+projecttopleft+'&budget=' +budgetTopLeft,function(result){
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
            });

            $("#btnTopRight").click(function(){
                topright_totalbudget.length = 0;
                topright_budgetplan.length = 0;
                topright_totalpayment.length = 0;
                topright_paymentplan.length = 0;
                topright_x.length = 0;

                $.getJSON("http://localhost/ob/topright.php?callback=?",'budget='+budgetTopRight,function(result){
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
            });
            
            $("#btnMiddleLeft").click(function(){
                rows_mid.length = 0;
                $.getJSON('http://localhost/ob/middleleft.php?callback=?','budget='+budgetMiddleLeft,function(result){
                    for (var i in result){
                        var rows1 = [];
                        rows1[0] = result[i][0];
                        rows1[1] = result[i][1]; 
                        rows1[2] = result[i][2]; 
                        rows1[3] = result[i][3]; 
                        rows1[4] = result[i][4]; 
                        rows1[5] = result[i][5]; 
                        rows_mid.push(rows1);
                    };
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Phase');
                    data.addColumn('number', 'Budget 1');
                    data.addColumn('number', '2013');
                    data.addColumn('number', '2014');
                    data.addColumn('number', '2015');
                    data.addColumn('number', 'Balance');
                    data.addRows(rows_mid);

                    var table = new google.visualization.Table(document.getElementById('bottom-right'));
                    table.draw(data, {showRowNumber: true});
                }); 
                // google.load('visualization', '1', {packages:['table']});
                // google.setOnLoadCallback(drawTable1);
                // drawTable1();
                // alert(rows_mid);
            });

            $("#btnBottomLeft").click(function(){
                rows_bottom.length = 0;
                $.getJSON("http://localhost/ob/bottomleft.php?callback=?","budget1="+budgetBottomRight1+"&budget2="+budgetBottomRight2,function(result){
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
                 });
                // google.load('visualization', '1', {packages:['table']});
                // google.setOnLoadCallback(drawTable2);
            });

            $("#optBudgetTopLeft" ).change(function() {
              budgetTopLeft = $(this).val();
            });

            $("#optProjectTopLeft" ).change(function() {
              projecttopleft = $(this).val();
            });

            $("#optBudgetTopRight" ).change(function() {
              budgetTopRight = $(this).val();
            });

            $("#budgetMiddleLeft" ).change(function() {
              budgetMiddleLeft = $(this).val();
            });

            $("#budgetBottomRight1" ).change(function() {
              budgetBottomRight1 = $(this).val();
            });

            $("#budgetBottomRight2" ).change(function() {
              budgetBottomRight2 = $(this).val();
            });
