var ChartView = Marionette.ItemView.extend({
    tagName : "div",
    attributes : {
        "style" : "height: 500px;",
        "data-foo" : "bar"
    },
    template : false,
    constructor : function() {
        Marionette.ItemView.apply(this, arguments);
    },
    initialize : function(options) {
        this.data = options.data;
        this.showChart();
        this.chart = new google.charts.Bar(this.el);
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
    },
    onShow : function() {
        var data = new google.visualization.DataTable(this.data);
        this.chart.draw(data, options_suma_srednia);
        console.log("CharView function onShow ", this.chart);
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
// var ChartListView = Marionette.CollectionView.extend({
// collection : ChartView
// });
var ChartController = Marionette.Object.extend({
    initialize : function(options) {
    },
    onStart : function() {
        console.log("ChartController onStart");
    },

    getChartView : function(param) {
        var chartView = new ChartView({
            data : lib.Chart.getJsonData(param)
        });
        return chartView;
    }
});

var options_suma_srednia = {
    width : 900,
    // chart : {
    // title : '',
    // subtitle : ''
    // },
    series : {
        0 : {
            axis : 'srednia',
            targetAxis : 0
        }
    // , // Bind series 0 to
    // // an axis named
    // // 'distance'.
    // 1 : {
    // axis : 'suma',
    // targetAxis : 0
    // }
    // , // Bind series 1 to an
    // // axis named
    // // 'brightness'.
    // 2 : {
    // axis : 'suma',
    // targetAxis : 1
    // }
    },
    axes : {
        y : {
            srednia : {
                label : 'Średnia'
            }
        // , // Left y-axis.
        // suma : {
        // side : 'right',
        // label : 'Suma punktów'
        // }
        // Right
        // y-axis.
        }
    }
};