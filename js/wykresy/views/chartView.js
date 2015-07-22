var ChartView = Marionette.ItemView.extend({
    tagName : "div",
    id : "ChartView",
    attributes : {
        "style" : "height: 500px;",
        "data-foo" : "bar"
    },
    template : false,
    // template : _
    // .template("<div id='ChartView' style='width: 500px;height:500px;'>to
    // jestwykres</div>"),
    ui : {
        mapContainer : "#ChartView"
    },
    constructor : function() {
        Marionette.ItemView.apply(this, arguments);
        this.showChart();
        this.chart = new google.charts.Bar(this.el);
    },
    initialize : function(options) {
        this.data = options.data;
        console.log("ChartView initialize ", options);
    },
    showChart : function() {
        console.log("ChartView function showChart");
        if (google.charts === undefined) {
            console.log("nie ma Bar");
            app.execute("load:google", this.showChart);
            return;
        }
        console.log("ChartView function showChart drawView");
        // this.chart = new google.charts.Bar(this.ui.mapContainer);
        // this.chart = new google.charts.Bar($("#ChartView")[0]);
        // this.chart.draw(lib.Chart.getJsonData(),
        // options_suma_srednia);
    },
    onShow : function() {
        var data = new google.visualization.DataTable(this.data);
        var data = google.visualization.arrayToDataTable([
                [ 'Genre', 'Fantasy & Sci Fi', 'Romance', 'Mystery/Crime',
                        'General', 'Western', 'Literature', {
                            role : 'annotation'
                        } ], [ '2010', 10, 24, 20, 32, 18, 5, '' ],
                [ '2020', 16, 22, 23, 30, 16, 9, '' ],
                [ '2030', 28, 19, 29, 30, 12, 13, '' ] ]);
        var options_suma_srednia = {
            width : 600,
            height : 400,
            legend : {
                position : 'top',
                maxLines : 3
            },
            bar : {
                groupWidth : '75%'
            },
            isStacked : true
        };
        this.chart.draw(data, options_suma_srednia);
        console.log("CharView function onShow ");
    },
    onAttach : function() {
        console.log("CharView function onAttach");
    },
    onRender : function() {
        console.log("CharView function onRender");
    },
    onClose : function() {
        console.log("CharView function onClose");
        this.chart = null;
    },
    onDestroy : function() {
        console.log("CharView function onClose");
    }
});
var ChartController = Marionette.Object.extend({
    initialize : function(options) {
    },
    onStart : function() {
        console.log("ChartController onStart");
    },

    getChartView : function() {
        var chartView = new ChartView({
            data : lib.Chart.getJsonData()
        });
        return chartView;
    }
});

var options_suma_srednia = {
    width : 900,
    chart : {
        title : 'Wykres sumy i średniej punktów w klasie',
        subtitle : 'Średnia i suma'
    },
    series : {
        0 : {
            axis : 'srednia',
            targetAxis : 0
        }, // Bind series 0 to
        // an axis named
        // 'distance'.
        1 : {
            axis : 'suma',
            targetAxis : 0
        }, // Bind series 1 to an
        // axis named
        // 'brightness'.
        2 : {
            axis : 'suma',
            targetAxis : 1
        }
    },
    axes : {
        y : {
            srednia : {
                label : 'Średnia'
            }, // Left y-axis.
            suma : {
                side : 'right',
                label : 'Suma punktów'
            }
        // Right
        // y-axis.
        }
    }
};