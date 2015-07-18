var NavItemView = Marionette.ItemView.extend({
    tagName : 'li',
    triggers : {
        "click a" : 'item:clicked'
    },
    template : _
            .template('<a href="#<%= name %>" id="<%= id %>"><%= name %></a>')
});
var NavComposite = Marionette.CompositeView.extend({
    template : "#nav-template",
    childView : NavItemView,
    childViewContainer : "#navitem-template",
    events : {
        "click .navbar-header a.navbar-brand" : "logoClicked"
    },
    logoClicked : function(e) {
        e.preventDefault();
        this.trigger("logo:clicked");
    },
});

var NavController = Marionette.Object.extend({
    initialize : function(options) {
    },
    onStart : function() {
        console.log("on start constoller");
    },
    getHeaderView : function(options) {
        var navItemss = app.reqres.request("get:header:items");
        var navView = new NavComposite({
            collection : new NavCollection(navItemss)
        });
        var self = this;
        navView.on('childview:item:clicked', function(view) {
            console.log("childview:item:clicked", view.model.get("event"));
            var event = view.model.get("event");
            // self.triggerMethod(event);
            app.execute(event);
        });
        navView.on('logo:clicked', function() {
            console.log("logo:clicked");
        });
        return navView;
    }
});