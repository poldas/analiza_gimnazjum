var LayoutView = Marionette.LayoutView
        .extend({
            template : "#app-container",
            regions : {
                main : "#main-region",
                header : "#header-region",
                obszar1 : "#obszar1-region",
                obszar2 : "#obszar2-region",
                obszar3 : "#obszar3-region",
                obszar4 : "#obszar4-region",
                o1klasaA : "#o1klasaA-region",
                o1klasaB : "#o1klasaB-region",
                o1klasaC : "#o1klasaC-region",
                o1klasaD : "#o1klasaD-region",
                o1klasaE : "#o1klasaE-region",
                o1klasaF : "#o1klasaF-region",
                o1klasaSzkola : "#o1klasaSzkola-region",
                o2klasaA : "#o2klasaA-region",
                o2klasaB : "#o2klasaB-region",
                o2klasaC : "#o2klasaC-region",
                o2klasaD : "#o2klasaD-region",
                o2klasaE : "#o2klasaE-region",
                o2klasaF : "#o2klasaF-region",
                o2klasaSzkola : "#o2klasaSzkola-region",
                o3klasaA : "#o3klasaA-region",
                o3klasaB : "#o3klasaB-region",
                o3klasaC : "#o3klasaC-region",
                o3klasaD : "#o3klasaD-region",
                o3klasaE : "#o3klasaE-region",
                o3klasaF : "#o3klasaF-region",
                o3klasaSzkola : "#o3klasaSzkola-region",
                o4klasaA : "#o4klasaA-region",
                o4klasaB : "#o4klasaB-region",
                o4klasaC : "#o4klasaC-region",
                o4klasaD : "#o4klasaD-region",
                o4klasaE : "#o4klasaE-region",
                o4klasaF : "#o4klasaF-region",
                o4klasaSzkola : "#o4klasaSzkola-region"
            },
            initialize : function(options) {
                this.controller = new LayoutViewController();
                var self = this;
                app.commands
                        .setHandler(
                                "show:chart",
                                function(opt) {

                                    if (opt.param == 'srednia') {
                                        opt.param = 'calosc';
                                    }
                                    if (opt.param != 'zadania') {
                                        self.chartView = self.controller
                                                .initializeChartView(opt.param);
                                        self.showChildView('main',
                                                self.chartView);
                                        self.o1klasaSzkola = self.controller
                                                .initializeChartView("obszar=I&"
                                                        + "rodzaj_danych="
                                                        + opt.param);
                                        self.o1klasaA = self.controller
                                                .initializeChartView("obszar=I&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=A");
                                        self.o1klasaB = self.controller
                                                .initializeChartView("obszar=I&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=B");
                                        self.o1klasaC = self.controller
                                                .initializeChartView("obszar=I&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=C");
                                        self.o1klasaD = self.controller
                                                .initializeChartView("obszar=I&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=D");
                                        self.o1klasaE = self.controller
                                                .initializeChartView("obszar=I&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=E");
                                        self.o1klasaF = self.controller
                                                .initializeChartView("obszar=I&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=F");
                                        self.showChildView('o1klasaA',
                                                self.o1klasaA);
                                        self.showChildView('o1klasaB',
                                                self.o1klasaB);
                                        self.showChildView('o1klasaC',
                                                self.o1klasaC);
                                        self.showChildView('o1klasaD',
                                                self.o1klasaD);
                                        self.showChildView('o1klasaE',
                                                self.o1klasaE);
                                        self.showChildView('o1klasaF',
                                                self.o1klasaF);
                                        self.showChildView('o1klasaSzkola',
                                                self.o1klasaSzkola);

                                        self.o2klasaSzkola = self.controller
                                                .initializeChartView("obszar=II&"
                                                        + "rodzaj_danych="
                                                        + opt.param);
                                        self.o2klasaA = self.controller
                                                .initializeChartView("obszar=II&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=A");
                                        self.o2klasaB = self.controller
                                                .initializeChartView("obszar=II&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=B");
                                        self.o2klasaC = self.controller
                                                .initializeChartView("obszar=II&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=C");
                                        self.o2klasaD = self.controller
                                                .initializeChartView("obszar=II&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=D");
                                        self.o2klasaE = self.controller
                                                .initializeChartView("obszar=II&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=E");
                                        self.o2klasaF = self.controller
                                                .initializeChartView("obszar=II&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=F");
                                        self.showChildView('o2klasaA',
                                                self.o2klasaA);
                                        self.showChildView('o2klasaB',
                                                self.o2klasaB);
                                        self.showChildView('o2klasaC',
                                                self.o2klasaC);
                                        self.showChildView('o2klasaD',
                                                self.o2klasaD);
                                        self.showChildView('o2klasaE',
                                                self.o2klasaE);
                                        self.showChildView('o2klasaF',
                                                self.o2klasaF);
                                        self.showChildView('o2klasaSzkola',
                                                self.o2klasaSzkola);

                                        self.o3klasaSzkola = self.controller
                                                .initializeChartView("obszar=III&"
                                                        + "rodzaj_danych="
                                                        + opt.param);
                                        self.o3klasaA = self.controller
                                                .initializeChartView("obszar=III&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=A");
                                        self.o3klasaB = self.controller
                                                .initializeChartView("obszar=III&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=B");
                                        self.o3klasaC = self.controller
                                                .initializeChartView("obszar=III&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=C");
                                        self.o3klasaD = self.controller
                                                .initializeChartView("obszar=III&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=D");
                                        self.o3klasaE = self.controller
                                                .initializeChartView("obszar=III&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=E");
                                        self.o3klasaF = self.controller
                                                .initializeChartView("obszar=III&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=F");
                                        self.showChildView('o3klasaA',
                                                self.o3klasaA);
                                        self.showChildView('o3klasaB',
                                                self.o3klasaB);
                                        self.showChildView('o3klasaC',
                                                self.o3klasaC);
                                        self.showChildView('o3klasaD',
                                                self.o3klasaD);
                                        self.showChildView('o3klasaE',
                                                self.o3klasaE);
                                        self.showChildView('o3klasaF',
                                                self.o3klasaF);
                                        self.showChildView('o3klasaSzkola',
                                                self.o3klasaSzkola);

                                        self.o4klasaSzkola = self.controller
                                                .initializeChartView("obszar=IV&"
                                                        + "rodzaj_danych="
                                                        + opt.param);
                                        self.o4klasaA = self.controller
                                                .initializeChartView("obszar=IV&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=A");
                                        self.o4klasaB = self.controller
                                                .initializeChartView("obszar=IV&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=B");
                                        self.o4klasaC = self.controller
                                                .initializeChartView("obszar=IV&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=C");
                                        self.o4klasaD = self.controller
                                                .initializeChartView("obszar=IV&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=D");
                                        self.o4klasaE = self.controller
                                                .initializeChartView("obszar=IV&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=E");
                                        self.o4klasaF = self.controller
                                                .initializeChartView("obszar=IV&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=F");
                                        self.showChildView('o4klasaA',
                                                self.o4klasaA);
                                        self.showChildView('o4klasaB',
                                                self.o4klasaB);
                                        self.showChildView('o4klasaC',
                                                self.o4klasaC);
                                        self.showChildView('o4klasaD',
                                                self.o4klasaD);
                                        self.showChildView('o4klasaE',
                                                self.o4klasaE);
                                        self.showChildView('o4klasaF',
                                                self.o4klasaF);
                                        self.showChildView('o4klasaSzkola',
                                                self.o4klasaSzkola);
                                    } else {
                                        opt.param = 'calosc';
                                        self.o1klasaSzkola = self.controller
                                                .initializeChartView("zadania&"
                                                        + "rodzaj_danych="
                                                        + opt.param);
                                        self.o1klasaA = self.controller
                                                .initializeChartView("zadania&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=A");
                                        self.o1klasaB = self.controller
                                                .initializeChartView("zadania&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=B");
                                        self.o1klasaC = self.controller
                                                .initializeChartView("zadania&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=C");
                                        self.o1klasaD = self.controller
                                                .initializeChartView("zadania&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=D");
                                        self.o1klasaE = self.controller
                                                .initializeChartView("zadania&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=E");
                                        self.o1klasaF = self.controller
                                                .initializeChartView("zadania&"
                                                        + "rodzaj_danych="
                                                        + opt.param
                                                        + "&klasa=F");
                                        self.showChildView('o1klasaA',
                                                self.o1klasaA);
                                        self.showChildView('o1klasaB',
                                                self.o1klasaB);
                                        self.showChildView('o1klasaC',
                                                self.o1klasaC);
                                        self.showChildView('o1klasaD',
                                                self.o1klasaD);
                                        self.showChildView('o1klasaE',
                                                self.o1klasaE);
                                        self.showChildView('o1klasaF',
                                                self.o1klasaF);
                                        self.showChildView('o1klasaSzkola',
                                                self.o1klasaSzkola);
                                    }
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
        this.chartInstance = this.chartController.getChartView(options);
        return this.chartInstance;
    },
    initializeChartViewCollection : function(options) {
        this.chartInstance = this.chartController
                .getChartViewCollection(options);
        return this.chartInstance;
    }
});