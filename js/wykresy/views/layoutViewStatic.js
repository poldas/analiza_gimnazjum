var LayoutViewStatic = Marionette.LayoutView.extend({
    template : "#app-container",
    regions : {
        main : "#main-region",
        header : "#header-region"
    },
    initialize : function(options) {
        console.log('tutaj');
        this.controller = new LayoutViewControllerStatic();
        var self = this;
        app.commands.setHandler("show:chart", function(opt) {
            console.log(opt);
            self.chartView = self.controller.initializeChartView(opt.collection);
            self.showChildView('main', self.chartView);
            // self.chartView.showChart();
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
        this.showChildView('header', this.navView);
    }
});

var LayoutViewControllerStatic = Marionette.Object.extend({
    initialize : function(options) {
        this.headerController = new NavController();
        this.chartController = new ChartCollectionController();
    },
    initializeNavBar : function(options) {
        this.headerInstance = this.headerController.getHeaderView();
        return this.headerInstance;
    },
    initializeChartView : function(options) {
        this.chartInstance = this.chartController.getChartViewCollection();
        return this.chartInstance;
    }
});