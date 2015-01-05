define(['goog!visualization,1.1,packages:[bar, corechart]', 'goog!search,1'], function() {
    function init() {
        drawChart();
    }
    function drawChart() {
        var data = new google.visualization.arrayToDataTable([
            DANE.sredniaPktKlasa
        ]);

        //var options = {
        //    chart: {
        //        title: 'Company Performance',
        //        subtitle: 'Sales, Expenses, and Profit: 2014-2017'
        //    }
        //    //bars: 'horizontal'
        //};
        ////var options = {
        ////    title : 'Monthly Coffee Production by Country',
        ////    vAxis: {title: "Cups"},
        ////    hAxis: {title: "Month"},
        ////    seriesType: "bars",
        ////    series: {5: {type: "line"}}
        ////};
        //var chart = new google.charts.Bar(document.getElementById('chart-sredniaPkt-klasa'));
        //
        //chart.draw(data);
        function drawStuff() {
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
                ['2004/05',  165,      938,         522,             998,           450,      614.6],
                ['2005/06',  135,      1120,        599,             1268,          288,      682],
                ['2006/07',  157,      1167,        587,             807,           397,      623],
                ['2007/08',  139,      1110,        615,             968,           215,      609.4],
                ['2008/09',  136,      691,         629,             1026,          366,      569.6]
            ]);
            var data = google.visualization.arrayToDataTable(DANE.sredniaPktKlasa);
            var options = {
                title : 'Średnia punktów i łatwość zadań w klasach',
                vAxis: {title: "Cups"},
                hAxis: {title: "Klasa"},
                seriesType: "bars",
                series: {2: {type: "line"}}
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart-sredniaPkt-klasa'));
            chart.draw(data, options);
        };
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['date', 'data1', 'data2', 'percentage'],
                [ "1 Mar", 289,  94, 0.10],  [ "2 Mar", 295,  96, 0.20],  [ "3 Mar", 300, 104, 0.30],
                [ "4 Mar", 306, 124, 0.40],  [ "5 Mar", 311, 142, 0.50],  [ "6 Mar", 317, 153, 0.60],
                [ "7 Mar", 322, 158, 0.70],  [ "8 Mar", 328, 164, 0.80],  [ "09Mar", 334, 164, 0.90],
                ["10 Mar", 339, 168, 0.80],  ["11 Mar", 345, 169, 0.70],  ["12 Mar", 351, 180, 0.60],
                ["13 Mar", 357, 190, 0.50],  ["14 Mar", 363, 200, 0.40],  ["15 Mar", 369, 210, 0.30],
                ["16 Mar", 375, 220, 0.20],  ["17 Mar", 381, 230, 0.10],  ["18 Mar", 387, 235, 0.00],
                ["19 Mar", 393, 240, -0.10],  ["20 Mar", 399, 250, -0.20],  ["21 Mar", 406, 245, -0.30],
                ["22 Mar", 412, 235, -0.40],  ["23 Mar", 418, 235, -0.50],  ["24 Mar", 425, 240, -0.60],
                ["25 Mar", 431, 245, -0.70],  ["26 Mar", 438, 255, -0.80],  ["27 Mar", 444, 260, -0.90],
                ["28 Mar", 451, 276, -0.80],  ["29 Mar", 458, 280, -0.70],  ["30 Mar", 464, 295, -0.60],
                ["31 Mar", 471, 310, -0.50]
            ]);
            var options = {
                title: 'Leads',
                hAxis: {showTextEvery: 5},
                vAxes: {
                    0: {
                        viewWindowMode:'explicit',
                        viewWindow:{
                            max:510,
                            min:82
                        },
                        gridlines: {color: 'transparent'}
                    },
                    1: {
                        gridlines: {
                            color: 'transparent'
                        },
                        format:"#%"
                    }
                },
                series: {
                    0: {
                            targetAxisIndex:0
                        },
                    1: {
                        targetAxisIndex:0
                    },
                    2: {
                        targetAxisIndex:1
                    }
                },
                colors: ["red", "green", "orange"],
                chartArea:{left:100,top:100, width:500, height:150}
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart-sredniaPkt-klasa'));
            chart.draw(data, options);
        }
        drawChart();
    }
    return {start: init};
});