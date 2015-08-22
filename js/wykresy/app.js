var Marionette = Backbone.Marionette;

var App = Marionette.Application.extend({
    onStart : function(options) {
        // główny element w którym będzie renderowana aplikacja
        // jako opcję przy starcie przekazujemy selektor
        this.mainView = new Marionette.Region({
            el : options.mainRegion
        });

        this.mainLayout = new options.mainLayout(options);
        this.mainView.show(this.getMainLayout());

    },
    onBeforeStart : function(options) {
        var self = this;
        this.reqres.setHandler("get:header:items", function() {
            return self.entityController.getItems();
        });
        this.commands.setHandler("load:google", function(callback) {
            var load = google.load('visualization', '1.1', {
                packages : [ 'corechart', 'bar' ],
                callback : callback
            });
        });
        this.commands.execute("load:google");
    },
    getMainLayout : function() {
        return this.mainLayout;
    },
    initialize : function(options) {
        this.entityController = new ChartEntityController();
        if (Backbone.history) {
            Backbone.history.start();
        }
    }
});
