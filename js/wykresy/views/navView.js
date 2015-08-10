var NavItemView = Marionette.ItemView
        .extend({
            tagName : 'li',
            triggers : {
                "click a" : 'item:clicked'
            },
            template : _
                    .template('<a href="<%= url %>#<%= id %>" id="<%= id %>"><%= name %></a>')
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
    initialize : function() {
        this.on('childview:item:clicked', function(view) {
            console.log("childview:item:clicked", view.model.get("event"));
            var event = view.model.get("event"), url = view.model.get("url");
            var param = view.model.get("param");
            if (url) {
                window.location.pathname = url;
            } else {
                app.execute(event, {
                    event : event,
                    param : param
                });
            }
        });
        this.on('logo:clicked', function() {
            console.log("logo:clicked");
        });
    }
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
        return navView;
    }
});
