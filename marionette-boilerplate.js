window.App = new Marionette.Application();

App.addRegions({
    appRegion: '#app',
    modalRegion: '#modal'
    
});

App.Router = Marionette.AppRouter.extend({
    appRoutes: {
        '': 'index'
    }
});

App.Controller = Marionette.Controller.extend({
    index: function() {
        var view = new App.IndexView();
        App.appRegion.show(view);
    }
});

App.IndexView = Marionette.ItemView.extend({
    tagName: 'h1',
    template: _.template('Hello Marionetjte')
});

App.on("start", function() {
    App.controller = new App.Controller();
    
    App.router = new App.Router({
        controller: App.controller
    });
        
    Backbone.history.start();
});

$(function(){
    App.start();
});