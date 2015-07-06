var Marionette = require('backbone.marionette');

var ChartApp = new Marionette.Object.extend({
    initialize : function(options) {
        var chartView = new ChartView({
            el : options.region
        })
        chartView.render();
    }
});
var ChartView = Marionette.ItemView.extend({
    tagName : 'div',
    render : function() {
        this.$el.html('to jest chart view');
    }
});

module.exports = ChartApp;
