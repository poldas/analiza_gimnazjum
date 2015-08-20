var ChartView2 = Marionette.ItemView.extend({
    tagName : "div",
    attributes : {
        "style" : "height: 500px;",
        "data-foo" : "bar"
    },
    template : false,
    initialize : function(options) {
        this.getGoogleChartLib();
        this.chart = new google.charts.Bar(this.el);
    },
    getGoogleChartLib : function() {
        if (google.charts === undefined) {
            app.execute("load:google", this.getGoogleChartLib);
            return;
        }
    },
    onShow : function() {
        var data = new google.visualization.DataTable(this.model.get('data'));
        this.chart.draw(data);
    }
});
var ChartListView = Marionette.CollectionView.extend({
    tagName : 'div',
    childView : ChartView2
});

var ChartCollectionController = Marionette.Object.extend({
    getChartViewCollection : function(param) {
        var data = lib.Chart.getData(param);
        return new ChartListView({
            collection : new Backbone.Collection(data)
        });
    }
});