define(['goog!visualization,1,packages:[corechart,table]', 'goog!search,1'], function() {
    function init() {
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn('number', 'Łatwość');
        dataTable.addColumn('number', 'Zadanie');
        dataTable.addRows(DANE.latwoscSzkola);


        var options = {
            title: 'Łatwość zadań w szkole',
            hAxis: {
                title: 'Numer zadania',
                titleTextStyle: {
                    color: '#333'
                },
                slantedText: true
            },
            vAxis: {
                title: 'Łatwość',
                minValue: 0
            },
            width: 1200,
            height: 300,
            orientation: 'horizontal'
        };
        var view = new google.visualization.DataView(dataTable);
        view.setColumns([1, 0]);

        var tableSzkola = new google.visualization.Table(document.getElementById('table-latwosc-szkola'));
        tableSzkola.draw(view, {});

        var chartSzkola = new google.visualization.ColumnChart(document.getElementById('chart-latwosc-szkola'));
        chartSzkola.draw(view, options);

        google.visualization.events.addListener(tableSzkola, 'sort',
            function (event) {
                dataTable.sort([{column: event.column, desc: !event.ascending}]);
                chartSzkola.draw(view, options);
            }
        );
    }
    return {start: init};
});