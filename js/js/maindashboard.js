$.blockUI.defaults.css = {
    border: 'none',
    padding: '15px',
    backgroundColor: '#000',
    '-webkit-border-radius': '10px',
    '-moz-border-radius': '10px',
    opacity: .5,
    color: '#fff'
}

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
var currency;

var topright_totalbudget = new Array();
var topright_budgetplan = new Array();
var topright_totalpayment = new Array();
var topright_paymentplan = new Array();
var topright_x = new Array();

var budgetTopRight;
var budgetMiddleLeft;
var budgetBottomLeft1;
var budgetBottomRight2;

var baseUrl = "http://localhost";
/* var init */

/* retrieve data */
/* ------------------------------------------------------------------------------- -------------------------------------------------------------------------------*/

refreshBudgetSelectionOption();

$.getJSON(baseUrl + "/ob/getproject.php?callback=?", function(j) {
    var options = '';
    options += '<option value="">All Project </option>';
    for (var i = 0; i < j.length; i++) {
        options += '<option value="' + j[i].c_project_id + '">' + j[i].name + '</option>';
    }
    $("select#optProjectTopLeft").html(options);
    $("select#globalproject").html(options);
    projecttopleft = $("#optProjectTopLeft").val();
});

$.getJSON(baseUrl + "/ob/getyear.php?callback=?", function(j) {
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
    globalyear = $("#globalyear").val();
});


var treegrid;
var data;


//refreshBudgetCost();
/* retrieve data */

var colorTotalPaymentplan = "blue";
var colorPaymentplan = "#8080ff";
var colorTotalBudget = "#ed2b50";
var colorBudget = "#fd3b60";
var colorTotalProgress = "#81c64d";

/* select */
$("#optBudgetTopLeft").change(function() {
    budgetTopLeft = $(this).val();
});

$("#optProjectTopLeft").change(function() {
    projecttopleft = $(this).val();
});

$("#optBudgetTopRight").change(function() {
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


$("#budgetMiddleLeft").change(function() {
    budgetMiddleLeft = $(this).val();
});
/* middleleft */
$("#budgetMiddleLeft").change(function() {
    budgetMiddleLeft = $(this).val();
});

$("#budgetBottomRight1").change(function() {
    budgetBottomRight1 = $(this).val();
});

$("#budgetBottomRight2").change(function() {
    budgetBottomRight2 = $(this).val();
});

/* bottomleft */
var rows_bottom = new Array();


var rows_bottommost = new Array();
google.load('visualization', '1', {packages: ['table']});
google.setOnLoadCallback(drawTable2);
//google.setOnLoadCallback(drawTable3);

function drawTable2() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Phase');
    data.addColumn('number', 'Budget A');
    data.addColumn('number', 'Budget B');
    data.addColumn('number', 'Variance');
    data.addRows(rows_bottom);

    //var table = new google.visualization.Table(document.getElementById('bottom-right2'));
    //table.draw(data, {showRowNumber: true});
}


function drawTable3() {
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
$("#btnGlobalProject").click(function() {
    refreshBudgetSelectionOption();
    globalproject_id;
    //refreshGantt();
    globalproject_id;


    budgetTopLeft;
    budgetMiddleLeft;
//    refreshBudgetCost();
    budgetTopRight;
    budgetBottomRight1;
    budgetBottomRight2;
    //alert("b. budget bottom right1 :"+budgetBottomRight1+", right 2:"+budgetBottomRight2);
//    refreshBudgetComparison();
//    refreshBudgetGrossNett();

});


$("#btnGlobalYear").click(function() {
    refreshBudgetSelectionOption();
    globalproject_id;
    //refreshGantt();
    globalproject_id;


    budgetTopLeft;
    budgetMiddleLeft;
//    refreshBudgetCost();
    budgetTopRight;
    budgetBottomRight1;
    budgetBottomRight2;
    //alert("b. budget bottom right1 :"+budgetBottomRight1+", right 2:"+budgetBottomRight2);
//    refreshBudgetComparison();

});

///---------------------------------------------------------------------------------------------------------------------------------------------
/// FUNCTIONS SECTION
///---------------------------------------------------------------------------------------------------------------------------------------------


function formatCurrency(val, row, index) {
    var region = $("#currency").val() == "idr" ? "id-ID" : "en-US";
    return $("<div>").append($("<div>", {text: val}).formatCurrency({region: region})).html();
}

function refreshGantt() {

    if (globalproject_id === null || globalproject_id === 'undefined' || !globalproject_id)
        globalproject_id = "";
    $.getJSON(baseUrl + "/ob/gantt.php?callback=?", "project=" + globalproject_id + '&year=' + globalyear, function(result) {
        if (ganttFirstRun) {
            gantt.config.scale_unit = "year";
            gantt.config.step = 1;
            gantt.config.date_scale = "%Y";
            gantt.config.min_column_width = 35;

            gantt.config.scale_height = 90;

            var monthScaleTemplate = function(date) {
                var dateToStr = gantt.date.date_to_str("%m");
                var endDate = gantt.date.add(date, 2, "month");
                return dateToStr(date) + " - " + dateToStr(endDate);
            };

            gantt.config.subscales = [
                {unit: "month", step: 3, template: monthScaleTemplate},
                {unit: "month", step: 1, date: "%m"}
            ];

            gantt.init("gantt_here");
            gantt.parse(result);
        } else {

            gantt.parse(result);
        }
    });
}

function refreshBudgetSelectionOption() {
    $.getJSON(baseUrl + "/ob/getbudget.php?callback=?", "&project=" + globalproject_id, function(j) {
        var options = '';
        for (var i = 0; i < j.length; i++) {
            options += '<option value="' + j[i].c_budget_id + '">' + j[i].name + '</option>';
        }
        $("select#optBudgetTopLeft").html(options);
        $("select#optBudgetTopRight").html(options);
        $("select#budgetMiddleLeft").html(options);
        $("select#budgetBottomRight1").html(options);
        var options = '';
        if (j.length > 1) {
            for (var i = 0; i < j.length; i++) {
                options += '<option value="' + j[i].c_budget_id + '">' + j[i].name + '</option>';
            }
        }
        $("select#budgetBottomRight2").html(options);

        budgetTopLeft = $("#optBudgetTopLeft").val();
        budgetTopRight = $("#optBudgetTopRight").val();
        budgetMiddleLeft = $("#budgetMiddleLeft").val();
        budgetBottomRight1 = $("#budgetBottomRight1").val();
        budgetBottomRight2 = $("#budgetBottomRight2").val();
    });
}


$(function() {
    initTblBudgetComparison();
    initTblBudgetCost();
    initTblBudgetGrossNet();
    initChartProgressForecastPayment();
    initChartCashFlow();
});

function initChartProgressForecastPayment() {
    var $chart = $('#top-left').highcharts({
        colors: [
            colorTotalProgress,
            colorTotalBudget,
            colorTotalPaymentplan
        ],
        chart: {
            zoomType: 'xy'
        },
        credits: {
            enabled: false
        },
        title: {
            text: 'Grafik Budget, Progress & Forecast Payment',
            style: {
                fontSize: '24px'
            }
        },
        subtitle: {
            text: 'Berisikan perbandingan data budget, progress proyek dan forecast payment'
        },
        xAxis: [{
                categories: topleft_x
            }],
        yAxis: [{// Primary yAxis
                labels: {
                    formatter: function() {
                        return this.value + '%';
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
                name: 'Actual Progress',
                //color: '#AA4643',
                type: 'column',
                yAxis: 0,
                index: 2,
                data: [],
                tooltip: {
                    valueSuffix: ' %'
                }

            }, {
                name: 'Budget',
                type: 'spline',
                dataLabels: {enabled: true},
                //color: '#95D2F7',
                yAxis: 0,
                index: 1,
                data: [],
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
                data: [],
                tooltip: {
                    valueSuffix: ' %'
                }
            }]
    });

    var $highcharts = $chart.highcharts();
    (update = function() {
        $chart.block();
        $.getJSON(baseUrl + '/ob/BudgetProgressPaymentplan.php', {
            project: $("#globalproject").val(),
            budget: $("#optBudgetTopLeft").val(),
            year: $("#globalyear").val()
        }, function(result) {
            $highcharts.xAxis[0].setCategories(result.datax);
            $highcharts.series[0].setData(result.databudget);
            $highcharts.series[1].setData(result.progress);
            $highcharts.series[2].setData(result.payment_plan);
            $chart.unblock();
        });
    })();

    $("#globalproject, #optBudgetTopLeft, #globalyear").change(update);
}

function initChartCashFlow() {
    var $chart = $('#top-right').highcharts({
        colors: [
            colorTotalBudget, //'#4572A7', 
            colorBudget, //'#80699B', 
            colorTotalPaymentplan, // '#89A54E', 
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
            text: 'Grafik Budget & Aliran Dana',
            style: {
                fontSize: '24px'
            }
        },
        subtitle: {
            text: 'menampilkan data aliran budget dan aliran dana '
        },
        xAxis: [{
                categories: []
            }],
        yAxis: [{// Primary yAxis
                labels: {
//                    formatter: function() {
//                        return prefix + this.value;
//                    },
                    style: {
                        color: '#89A54E'
                    }
                },
                title: {
//                    text: currInfo,
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
                name: 'Month to Date Budget',
                type: 'spline',
                yAxis: 0,
//                index: 2,
                dashStyle: 'ShortDash',
                marker: {
                    enabled: false
                },
                data: [],
                tooltip: {
                    //valueSuffix: ' Billion',
//                    valuePrefix: prefix
                }

            }, {
                name: 'Monthly Budget',
                type: 'column',
                dataLabels: {
                    enabled: true
                },
                yAxis: 0,
//                index: 1,
                data: [],
                tooltip: {
                    //valueSuffix: ' Billion',
//                    valuePrefix: prefix
                }

            }, {
                name: 'Month to Date Payment',
                type: 'spline',
//                index: 3,
                dashStyle: 'ShortDash',
                marker: {
                    enabled: false
                },
                data: [],
                tooltip: {
                    //valueSuffix: ' Billion',
//                    valuePrefix: prefix
                }
            }, {
                name: 'Forecast Payment',
                type: 'column',
                dataLabels: {
                    enabled: true
                },
                yAxis: 0,
//                index: 1,
                data: [],
                marker: {
                    enabled: false
                },
                tooltip: {
                    //valueSuffix: ' Billion',
//                    valuePrefix: prefix
                }

            }]
    });

    var $highcharts = $chart.highcharts();
    console.log($highcharts);
    (update = function() {
        $chart.block();

        var prefix = "Rp. ";
        var currInfo = "Rupiah";
        if (currency === 'usd') {
            prefix = "$ ";
            currInfo = "USD";
        }

        $.getJSON(baseUrl + "/ob/BudgetCashflow.php", {
            budget: $("#optBudgetTopRight").val(),
            year: $("#globalyear").val(),
            currency: $("#currency").val(),
            project: $("#globalproject").val()
        }, function(result) {
            $highcharts.xAxis[0].setCategories(result.datax);
            $highcharts.series[0].setData(result.totalbudget);
            $highcharts.series[1].setData(result.budgetplan);
            $highcharts.series[2].setData(result.totalpayment);
            $highcharts.series[3].setData(result.paymentplan);
            $highcharts.yAxis[0].setTitle({text: currInfo});
            $chart.unblock();
        });
    })();

    $("#optBudgetTopRight, #globalyear, #currency, #globalproject").change(update);
}

function initTblBudgetComparison() {
    // handle events
    $("#budgetBottomRight1 option:eq(0)").prop("selected", true);
    $("#budgetBottomRight2 option:eq(1)").prop("selected", true);

    $("#tbl-budgetComparison").treegrid({
        url: baseUrl + "/ob/BudgetComparison.php",
        idField: "id",
        queryParams: {
            budget1: $("#budgetBottomRight1").val(),
            budget2: $("#budgetBottomRight2").val(),
            project_id: $("#globalproject").val(),
            currency: $("#currency").val()
        },
        treeField: "name",
        columns: [[
                {
                    title: "BUDGET > PROJECT > GROUP > PHASE >TASK ",
                    field: "name",
                    width: 800
                },
                {
                    title: "Budget 1",
                    field: "budget_1",
                    width: 200,
                    formatter: formatCurrency
                },
                {
                    title: "Budget 2 ",
                    field: "budget_2",
                    width: 200,
                    formatter: formatCurrency
                }
            ]]
    });

    $("#currency, #budgetBottomRight1, #budgetBottomRight2, #globalproject")
            .change(function() {
                $("#tbl-budgetComparison").treegrid('reload', {
                    budget1: $("#budgetBottomRight1").val(),
                    budget2: $("#budgetBottomRight2").val(),
                    project_id: $("#globalproject").val(),
                    currency: $("#currency").val()
                });
            })




}

function initTblBudgetCost() {
    $("#tbl-budgetCost").treegrid({
        url: baseUrl + "/ob/BudgetCost.php",
        queryParams: {
            currency: $("#currency").val(),
            project_id: $("#globalproject").val(),
            budget_id: $("#budgetMiddleLeft").val()
        },
        idField: "id",
        treeField: "NAME",
        columns: [[
                {
                    field: "NAME",
                    title: "BUDGET > PROJECT > GROUP > PHASE > TASK",
                    width: 470
                },
                {
                    field: "TOTAL",
                    title: "Total",
                    width: 100,
                    align: "right",
                    formatter: formatCurrency
                },
                {
                    field: "BALANCE",
                    title: "Balance",
                    width: 100,
                    align: "right",
                    formatter: formatCurrency
                },
                {
                    field: "Tahun_2010",
                    title: "2010",
                    width: 100,
                    align: "right",
                    formatter: formatCurrency
                },
                {
                    field: "Tahun_2011",
                    title: "2011",
                    width: 100,
                    align: "right",
                    formatter: formatCurrency
                },
                {
                    field: "Tahun_2012",
                    title: "2012",
                    width: 100,
                    align: "right",
                    formatter: formatCurrency
                },
                {
                    field: "Tahun_2013",
                    title: "2013",
                    width: 100,
                    align: "right",
                    formatter: formatCurrency
                },
                {
                    field: "Tahun_2014",
                    title: "2014",
                    width: 100,
                    align: "right",
                    formatter: formatCurrency
                },
                {
                    field: "Tahun_2015",
                    title: "2015",
                    width: 100,
                    align: "right",
                    formatter: formatCurrency
                },
            ]]
    });

    $("#currency, #budgetMiddleLeft, #globalproject").change(function(e) {
        $("#tbl-budgetCost").treegrid('reload', {
            currency: $("#currency").val(),
            project_id: $("#globalproject").val(),
            budget_id: $("#budgetMiddleLeft").val()
        });

    });
}

function initTblBudgetGrossNet() {
    $("#tbl-budgetGrossNet").datagrid({
        url: baseUrl + "/ob/BudgetGrossNett.php",
        fitColumns: true,
        singleSelect: true,
        columns: [[
                {
                    field: 'name',
                    title: 'Budget Name',
                    width: 100
                },
                {
                    field: 'budget',
                    title: 'Budget',
                    width: 100,
                    align: 'right',
                    formatter: formatCurrency
                },
                {
                    field: 'gross_floor_area',
                    title: 'Gross Floor Area',
                    width: 100,
                    align: 'right',
                    formatter: formatCurrency
                },
                {
                    field: 'budget_per_gross',
                    title: 'Budget Per Gross',
                    width: 100,
                    align: 'right',
                    formatter: formatCurrency
                },
                {
                    field: 'rent_floor_area',
                    title: 'Rent Floor Area',
                    width: 100,
                    align: 'right',
                    formatter: formatCurrency
                },
                {
                    field: 'budget_per_nett',
                    title: 'Budget Per Nett',
                    width: 100,
                    align: 'right',
                    formatter: formatCurrency
                }
            ]]
    });

    $("#currency, #globalproject").change(function(e) {
        $("#tbl-budgetGrossNet").datagrid('reload', {
            currency: $("#currency").val(),
            project_id: $("#globalproject").val()
        });
    });
}


			