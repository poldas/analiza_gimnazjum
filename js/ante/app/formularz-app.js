var UserTracker = new Backbone.Marionette.Application();

var User = Backbone.Model.extend({});
var Users = Backbone.Collection.extend({
	model: User
});

var UserView = Backbone.Marionette.ItemView.extend({
	template: '#userView'
});
var NoUsersView = Backbone.Marionette.ItemView.extend({
	template: '#nousersView'
});
var UsersView = Backbone.Marionette.CollectionView.extend({
	childView: UserView,
	emptyView: NoUsersView
});

var FormView = Backbone.Marionette.ItemView.extend({
	template: '#formView',
	events: {
		'click button': 'createNewUser'
	},
	ui: {
		name: '#name',
		age: '#age'
	},
	createNewUser: function(e) {
		e.preventDefault();
		this.collection.add({
			name: this.ui.name.val(),
			age: this.ui.age.val()
		});
		this.ui.name.val('');
		this.ui.age.val('');
	}
});

UserTracker.addRegions({
	form: '#form',
	list: '#list'
});

UserTracker.addInitializer(function(){
	UserTracker.users = new Users();
	UserTracker.form.show(new FormView({collection: UserTracker.users}));
	UserTracker.list.show(new UsersView({collection: UserTracker.users}));
});

UserTracker.start();