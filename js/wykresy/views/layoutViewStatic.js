var LayoutViewStatic = Marionette.LayoutView.extend({
    template : "#layout-static-template",
    regions : {
        main : "#main-content",
        sidebar : "#sidebar-wrapper"
    },
    initialize : function(options) {
        this.controller = new LayoutViewControllerStatic();
        var self = this;
        app.commands.setHandler("show:chart", function(opt) {
            self.chartView = self.controller.initializeChartView(opt);
            self.showChildView('main', self.chartView);
        });
        app.commands.setHandler("close:chart", function() {
            var view = self.getRegion("main").empty();
        });
        app.commands.setHandler("change:chart", function() {
            var view = self.getRegion("main").empty();
        })
    },
    onBeforeShow : function(options) {
        this.navView = this.controller.initializeNavBar();
        this.showChildView('sidebar', this.navView);
    }
});

var LayoutViewControllerStatic = Marionette.Object.extend({
    initialize : function(options) {
        this.headerController = new NavControllerStatic();
        this.chartController = new ChartCollectionController();
    },
    initializeNavBar : function(options) {
        this.headerInstance = this.headerController.getHeaderViewStatic();
        return this.headerInstance;
    },
    initializeChartView : function(options) {
        this.chartInstance = this.chartController.getChartViewCollection(options.param);
        return this.chartInstance;
    }
});