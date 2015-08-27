var ChartView2 = Marionette.ItemView.extend({
    tagName : "div",
    attributes : {
        "style" : "height: 400px;"
    },
    template : false,
    initialize : function(options) {
        this.getGoogleChartLib();
//        this.chart = new google.charts.Bar(this.el);
        this.chart = new google.visualization.ComboChart(this.el);
    },
    getGoogleChartLib : function() {
        if (google.charts === undefined) {
            app.execute("load:google", this.getGoogleChartLib);
            return;
        }
    },
    onShow : function() {
    	var dane = this.model.get('data');
//        var data = new google.visualization.DataTable(dane);
        var view = new google.visualization.DataView(data);
//        view.setColumns([0, 1,
//                         { calc: "stringify",
//                           sourceColumn: 0,
//                           type: "string",
//                           role: "annotation" },
//                         1]);
        this.chart.draw(view, { series: {
            0: {
                type: 'bars'
              },hAxis: {
                  viewWindow: {
                      min: 0,
                      max: 1
                  }},
            },'tooltip' : {
            	  trigger: 'none'
            }});
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
            collection : new Backbone.Collection(JSON.parse(data))
        });
    }
});