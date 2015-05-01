APP.module("navigationbar", function(navbar, App, Backbone, Marionette, $, _) {
	var NavbarView = Backbone.Marionette.ItemView.extend({
		el : 'nav',
		template: false,
		ui: {
			import: '#import',
			statystyka: '#statystyka'
		},
		events: {
			'click @ui.import': 'wyczysc',
			'click @ui.statystyka': 'pokaz'
		},
		wyczysc: function(e) {
			console.log('usun');
			App.module('wykres').stop();
			navbar.stop();
		},
		pokaz: function(e) {
			console.log('pokaz');
			App.module('wykres').start();
		}
	});
	
	navbar.on("before:start", function() {
		// do stuff before the module is started
		console.log('navbar before:start');
	});

	navbar.on("start", function() {
		// do stuff after the module has been started
		console.log('navbar start');
		App.rootView.nav.show(new NavbarView());
	});
	navbar.on("stop", function() {
		console.log('navbar stop');
		App.rootView.nav.empty();
	});
});