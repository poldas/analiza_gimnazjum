var app = new App();
app.on('start', function(options) {
    console.log("app on.start handler", options);
});
app.on('before:start', function(options) {
    console.log("app before:start handler", options);
});
app.start({
    mainLayout : LayoutView,
    mainRegion : "#app-container",
    cos : 'cos'
});
