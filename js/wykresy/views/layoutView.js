var LayoutView = Marionette.LayoutView.extend({
    template : "#app-container",
    regions : {
        main : "#main-region",
        header : "#header-region"
    },
    initialize : function(options) {
        console.log("LayoutView initialize function", options);
        this.controller = new LayoutViewController();
        var self = this;
        app.commands.setHandler("show:chart", function(opt) {
            console.log("LayoutView show:chart setHandler", opt);
            self.chartView = self.controller.initializeChartView();
            self.showChildView('main', self.chartView);
            // self.chartView.showChart();
        });
        app.commands.setHandler("close:chart", function() {
            console.log("LayoutView close:chart setHandler", options);
            var view = self.getRegion("main").empty();
        });
        app.commands.setHandler("change:chart", function() {
            console.log("LayoutView change:chart setHandler", options);
            var view = self.getRegion("main").empty();
        })
    },
    onBeforeShow : function(options) {
        console.log("LayoutView onBeforeShow function", options);
        this.navView = this.controller.initializeNavBar();
        this.showChildView('header', this.navView);
        // this.showChildView('main', this.chartView);
    },
    onShow : function(options) {
        console.log("LayoutView onShow function", app.reqres);
    }
});

var LayoutViewController = Marionette.Object.extend({
    initialize : function(options) {
        this.headerController = new NavController();
        this.chartController = new ChartController();
    },
    initializeNavBar : function(options) {
        this.headerInstance = this.headerController.getHeaderView();
        return this.headerInstance;
    },
    initializeChartView : function(options) {
        this.chartInstance = this.chartController.getChartView();
        return this.chartInstance;
    }
});