var APP = new Backbone.Marionette.Application();
var RootView = Marionette.LayoutView.extend({
	el : 'body',
	regions : {
		nav : '#navbar',
		content : '#content',
		lista : '#lista',
		formModule : '#formModule',
	}
});
APP.rootView = new RootView();


APP.on('before:start', function(options) {
	options.anotherThing = true; // Add more data to your options
	console.log('App Initialization Before');
});
APP.addInitializer(function() {
	console.log('App Add Initialization');
});
APP.on('start', function(options) {
	console.log('App Initialization Start');
});

APP.start({});