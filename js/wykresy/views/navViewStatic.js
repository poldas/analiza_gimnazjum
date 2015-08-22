var NavItemViewStatic = Marionette.ItemView
		.extend({
			attributes : {
				"data-spy" : "affix",
				"data-offset-top" : "60"
			},
			tagName : 'li',
			triggers : {
				"click a" : 'item:clicked'
			},
			template : _
					.template('<a href="<%= url %>#<%= id %>" id="<%= id %>"><%= name %></a>')
		});

var NavCompositeStatic = Marionette.CompositeView.extend({
	template : "#nav-scroll-template",
	childView : NavItemViewStatic,
	childViewContainer : "#nav",
	initialize : function() {
		this.on('childview:item:clicked',
				function(view) {
					var event = view.model.get("event"), url = view.model
							.get("url"), param = view.model.get("param");
					app.execute(event, {
						event : event,
						param : param
					});
				});
	}
});

var NavControllerStatic = Marionette.Object.extend({
	getHeaderViewStatic : function(options) {
		var navItemss = app.reqres.request("get:header:items");
		var navView = new NavCompositeStatic({
			collection : new NavCollection(navItemss)
		});
		return navView;
	}
});
