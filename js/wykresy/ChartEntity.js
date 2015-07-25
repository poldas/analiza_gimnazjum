var NavModel = Backbone.Model.extend({});
var NavCollection = Backbone.Collection.extend({
    model : NavModel
});
var navItems = [ {
    name : "Statystyka",
    event : "show:chart",
    id : "statystyka"
}, {
    name : "Import",
    event : "close:chart",
    id : "import"
}, {
    name : "Php-wykrese",
    event : "change:chart",
    id : "php wykresy"
} ];

var ChartEntityController = Marionette.Object.extend({
    getItems : function() {
        return navItems;
    }
});
var API = (function(api){
	api.getNavCollection = function(data){
		return new NavCollection({collection:data});
	}

	return api;
}(API || {}));
