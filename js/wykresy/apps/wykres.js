APP.module("wykres", function(wykres, App, Backbone, Marionette, $, _) {
	var User = Backbone.Model.extend({});
	var Users = Backbone.Collection.extend({
		model : User
	});
	var UserView = Backbone.Marionette.ItemView.extend({
		template : '#userView'
	});
	var NoUsersView = Backbone.Marionette.ItemView.extend({
		template : '#nousersView'
	});
	var UsersView = Backbone.Marionette.CollectionView.extend({
		childView : UserView,
		emptyView : NoUsersView
	});
	var FormView = Backbone.Marionette.ItemView.extend({
		el : '#formView',
		template : false,
		events : {
			'click button' : 'createNewUser',
			'click .close' : 'close'
		},
		ui : {
			name : '#name',
			age : '#age'
		},
		close: function(e) {
			wykres.stop();
			console.log(wykres);
		},
		createNewUser : function(e) {
			e.preventDefault();
			this.collection.add({
				name : this.ui.name.val(),
				age : this.ui.age.val()
			});
			this.ui.name.val('');
			this.ui.age.val('');
		}
	});

	// Private Data And Functions()
	var privateData = "this is private data";

	var privateFunction = function() {
		console.log(privateData);
	}

	// Public Data And Functions
	wykres.someData = "public data";

	wykres.someFunction = function() {
		privateFunction();
		console.log(wykres.someData);
	}

	wykres.on("before:start", function() {
		// do stuff before the module is started
		console.log('wykres before:start');
		wykres.someFunction();
	});

	wykres.on("start", function() {
		// do stuff after the module has been started
		console.log('wykres start');
		App.users = new Users();
		App.rootView.content.show(new FormView({
			collection : App.users
		}));
		App.rootView.lista.show(new UsersView({
			collection : App.users
		}));
	});
	wykres.on("stop", function() {
		// do stuff before the module is started
		console.log('wykres stop');
		App.rootView.content.empty();
		App.rootView.lista.empty();
	});
});