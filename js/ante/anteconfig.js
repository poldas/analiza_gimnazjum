requirejs.config({
    //By default load any module IDs from js/lib
    baseUrl: 'js/ante/app',
    //except, if the module ID starts with "app",
    //load it from the js/app directory. paths
    //config is relative to the baseUrl, and
    //never includes a ".js" extension since
    //the paths config could be for a directory.
    paths: {
        lib: '../lib',
        jquery: '../lib/jquery-2.1.3.min',
        async : '../lib/async',
        goog : '../lib/goog',
        propertyParser : '../lib/propertyParser',
        underscore: '../lib/underscorejs-1.7.0.min',
        latwoscSzkola: 'charts/latwoscSzkola',
        latwoscKlasa: 'charts/latwoscKlasa',
        sredniaPktKlasa: 'charts/sredniaPktKlasa',
        latwoscObszar: 'charts/latwoscObszar',
        spreadsheetChart: 'charts/spreadsheet'
    }
});

require(['router']);