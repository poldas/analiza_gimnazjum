var NavModel = Backbone.Model.extend({});
var NavCollection = Backbone.Collection.extend({
    model : NavModel
});
var navItems = [ {
    name : "Test",
    event : "show:chart",
    id : "statystyka-all",
    param : 'all',
    url : ""
}, {
    name : "Stat całość",
    event : "show:chart",
    id : "statystyka-calosc",
    param : 'srednia',
    url : ""
}, {
    name : "Lokalizacja",
    event : "show:chart",
    id : "statystyka-lokalizacja",
    param : 'lokalizacja',
    url : ""
}, {
    name : "Płeć",
    event : "show:chart",
    id : "statystyka-plec",
    param : 'plec',
    url : ""
}, {
    name : "Dysleksja",
    event : "show:chart",
    id : "statystyka-dysleksja",
    param : 'dysleksja',
    url : ""
}, {
    name : "Zadania",
    event : "show:chart",
    id : "statystyka-zadania",
    param : 'zadania',
    url : ""
}, {
    name : "Obszary",
    event : "show:chart",
    id : "statystyka-obszar",
    param : 'obszar=I&klasa=A&rodzaj_danych=dysleksja',
    url : ""
}, {
    name : "Usuń wykres",
    event : "close:chart",
    id : "usun",
    param : '',
    url : ""
}, {
    name : "Dane-json",
    event : "change:chart",
    id : "php wykresy",
    param : '',
    url : "/analiza/php/ante/wykresy.php"
}, {
    name : "Dodaj dane",
    event : "change:chart",
    id : "dodaj-dane",
    param : '',
    url : "/analiza/php/ante/test.php"
} ];

var ChartEntityController = Marionette.Object.extend({
    getItems : function() {
        return navItems;
    }
});
var API = (function(api) {
    api.getNavCollection = function(data) {
        return new NavCollection({
            collection : data
        });
    }

    return api;
}(API || {}));
