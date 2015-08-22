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
    	console.log(options);
        this.data = options.data;
        this.showChart();
        this.chart = new google.charts.Bar(this.el);
    },
    showChart : function() {
        if (google.charts === undefined) {
            app.execute("load:google", this.showChart);
            return;
        }
    },
    onShow : function() {
        var data = new google.visualization.DataTable(this.data);
        this.chart.draw(data);
    }
});
var ChartController = Marionette.Object.extend({
    getChartView : function(param) {
    	console.log(param);
        var chartView = new ChartView({
            data : lib.Chart.getJsonData(param)
        });
        return chartView;
    },
    getChartViewCollection : function(param) {
        var chartView = new ChartListView({
            model : lib.Chart.getJsonData(param)
        });
        return chartView;
    }
});
