var Marionette = Backbone.Marionette;
var lib = {};
lib.Chart = {
    getOptions : function() {
        options_suma_srednia = {
            width : 900,
            chart : {
                title : 'Wykres sumy i średniej punktów w klasie',
                subtitle : 'Średnia i suma'
            },
            series : {
                0 : {
                    axis : 'srednia',
                    targetAxis : 0
                }, // Bind series 0 to
                // an axis named
                // 'distance'.
                1 : {
                    axis : 'suma',
                    targetAxis : 0
                }, // Bind series 1 to an
                // axis named
                // 'brightness'.
                2 : {
                    axis : 'suma',
                    targetAxis : 1
                }
            },
            axes : {
                y : {
                    srednia : {
                        label : 'Średnia'
                    }, // Left y-axis.
                    suma : {
                        side : 'right',
                        label : 'Suma punktów'
                    }
                // Right
                // y-axis.
                }
            }
        };
        return options_suma_srednia;
    },
    getJsonData : function() {

        var jsonData = $.ajax({
            url : "php/ante/dane.php",
            dataType : "json",
            async : false
        }).responseText;
        var data = new google.visualization.DataTable(jsonData);
        return data;
    }
};
var ChartView = Marionette.ItemView
        .extend({
            template : function() {
                console.log("template ChartView ");
                return _
                        .template("<div id='ChartView' style='width: 500px;height:500px;'>to jest wykres</div>")
            },
            initialize : function(options) {
                console.log("initialize ChartView ");
                google.load('visualization', '1.1', {
                    packages : [ 'corechart', 'bar' ]
                });
                google.setOnLoadCallback(this.showChart);
            },
            showChart : function() {
                var self = this;
                self.chart = new google.charts.Bar($('#ChartView')[0]);
                self.chart
                        .draw(lib.Chart.getJsonData(), lib.Chart.getOptions());
            },
            onAttach : function() {
                console.log("function onAttach CharView");
            }
        });
var LayoutView = Marionette.LayoutView.extend({
    template : "#app-layout",
    regions : {
        one : "#one-row",
        second : "#second-row"
    },
    onBeforeShow : function() {
        this.showChildView('one', new ChartView());
        this.showChildView('second', new FormView());
    }
});
var RegionView = Marionette.Region.extend({
    el : "#main-region",
});
var App = Marionette.Application.extend({
    start : function(options) {
        console.log("start function");
        this.trigger('start', options);
    },
    initialize : function(options) {
        console.log('initialize function', options);
        this.mainView = new options.RegionView();
        this.layout = new options.LayoutView();
        this.trigger("before:start");
    },
    onBeforeStart : function(options) {
        console.log("onBeforeStart function", google);
    },
    onStart : function(options) {
        console.log("onstart function");
    },
});

var app = new App({
    RegionView : RegionView,
    LayoutView : LayoutView
});

app.on('start', function(options) {
    console.log("start handler");
    if (Backbone.history) {
        Backbone.history.start();
    }
    // layout.render();
    this.mainView.show(this.layout);
});

app.on("before:start", function(options) {
    console.log("before:start handler");
});

var FormView = Marionette.ItemView.extend({
    template : '#formView'
});
var SecondView = Marionette.ItemView.extend({
    initialize : function() {
        console.log('initialize SecondView function');
    },
    tagName : 'div',
    render : function() {
        console.log('render SecondView function');
        this.$el.html('to jest chart SecondView');
    }
});
app.start({
    LayoutView : LayoutView,
    RegionView : RegionView
});
