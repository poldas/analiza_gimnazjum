var Marionette = Backbone.Marionette;

var App = Marionette.Application.extend({
    onStart : function(options) {
        console.log("App onStart function", options);
        // główny element w którym będzie renderowana aplikacja
        // jako opcję przy starcie przekazujemy selektor
        this.mainView = new Marionette.Region({
            el : options.mainRegion
        });

        this.mainLayout = new options.mainLayout(options);
        this.mainView.show(this.getMainLayout());

    },
    onBeforeStart : function(options) {
        console.log("App onBeforeStart function");
        var self = this;
        this.reqres.setHandler("get:header:items", function() {
            console.log("get:header:items");
            return self.entityController.getItems();

        });
        this.commands.setHandler("load:google", function(callback) {
            console.log("load:google");
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
        console.log('App initialize', options);
        this.entityController = new ChartEntityController();
        if (Backbone.history) {
            Backbone.history.start();
        }
    }
});
