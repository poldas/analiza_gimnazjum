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
        underscore: '../lib/underscorejs-1.7.0.min'
    }
});

require(['analiza']);