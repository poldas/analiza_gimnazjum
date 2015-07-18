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
        app.commands.setHandler("show:chart", function() {
            console.log("LayoutView show:chart setHandler", options);
            self.chartView = self.controller.initializeChartView();
            self.showChildView('main', self.chartView);
            // self.chartView.showChart();
        });
        app.commands.setHandler("close:chart", function() {
            console.log("LayoutView close:chart setHandler", options);
            self.chartView.destroy();
            self.getRegion("main").destroy();
        });
    },
    onBeforeShow : function(options) {
        console.log("LayoutView onBeforeShow function", options);
    },
    onShow : function(options) {
        console.log("LayoutView onShow function", app.reqres);
        this.navView = this.controller.initializeNavBar();
        this.showChildView('header', this.navView);
        // this.showChildView('main', this.chartView);
    }
});

var LayoutViewController = Marionette.Object.extend({
    initialize : function(options) {
        this.headerController = new NavController();
        this.chartController = new ChartController();
    },
    initializeNavBar : function(options) {
        return this.headerController.getHeaderView();
    },
    initializeChartView : function(options) {
        return this.chartController.getChartView();
    }
});