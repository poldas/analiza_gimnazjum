// app.js
var Backbone = require('backbone');
var jquery = require('jquery');
Backbone.$ = jquery;
var Marionette = require('backbone.marionette');
var _ = require('underscore'); // or lodash

var App = Marionette.Application.extend({
    initialize : function(options) {
        this._subApps = {};
        this.layoutView = null;
    },
    addSubApp : function(name, options) {
        // pomija 'subAppClass' z dostepnych opcji
        var subAppOptions = _.omit(options, 'subAppClass');

        // tworzy nowa instancje modulu i dodaje do listy moduluw
        var subApp = new options.subAppClass(subAppOptions);
        this._subApps[name] = subApp;
    },
    addLayoutView : function(layoutView) {
        this.layoutView = layoutView;
    },
    getSupApp : function(name) {
        return this._subApps[name] !== undefined ? this._subApps[name] : {};
    }
});

module.exports = App;
