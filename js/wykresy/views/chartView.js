var ChartView = Marionette.ItemView
        .extend({
            template : _
                    .template("<div id='ChartView' style='width: 500px;height:500px;'>to jest wykres</div>"),
            ui : {
                mapContainer : "#ChartView"
            },
            constructor : function() {
                Marionette.ItemView.apply(this, arguments);
            },
            initialize : function(options) {
                console.log("ChartView initialize ", options);
                // app.execute("load:google", this.showChart);
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
                this.chart = new google.charts.Bar($("#ChartView")[0]);
                this.chart
                        .draw(lib.Chart.getJsonData(), lib.Chart.getOptions());
            },
            onShow : function() {
                console.log("CharView function onShow ");
            },
            onAttach : function() {
                console.log("CharView function onAttach");
                this.showChart();
            },
            onRender : function() {
                console.log("CharView function onRender");
            },
            onClose : function() {
                console.log("CharView function onClose");
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
        var chartView = new ChartView();
        return chartView;
    }
});