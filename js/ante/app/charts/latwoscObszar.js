define(['goog!visualization,1,packages:[corechart,table]', 'goog!search,1'], function() {
    function init() {
        var optionsKlasa = {
            title: 'latwosc per obszar, umiejetnosc, klasa ',
            is3D: true,
            hAxis: {
                title: 'Obszar',
                titleTextStyle: {
                    color: '#333'
                }
            },
            width: 1200,
            height: 300,
            vAxis: {
                title: 'Umiejętność',
                minValue: 0
            },
            orientation: 'vertical'
        };
        var dataTableKlasa = new google.visualization.DataTable();
        dataTableKlasa.addColumn('string', 'Obszar / Umiejętność');
        dataTableKlasa.addColumn('number', 'Łatwość');
        dataTableKlasa.addRows(DANE.latwoscObszar);
        var viewKlasa = new google.visualization.DataView(dataTableKlasa);
        viewKlasa.setColumns([0, 1]);
        var tableKlasa = new google.visualization.Table(document.getElementById('table-latwosc-obszar'));
        tableKlasa.draw(viewKlasa, {});

        var chartKlasa = new google.visualization.ColumnChart(document.getElementById('chart-latwosc-obszar'));
        chartKlasa.draw(viewKlasa, optionsKlasa);

        google.visualization.events.addListener(tableKlasa, 'sort',
            function (event) {
                dataTableKlasa.sort([{column: event.column, desc: !event.ascending}]);
                chartKlasa.draw(viewKlasa, optionsKlasa);
            }
        );
    }
    return {start: init};
});