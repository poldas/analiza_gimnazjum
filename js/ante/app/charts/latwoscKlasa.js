define(['goog!visualization,1,packages:[corechart,table]', 'goog!search,1'], function() {
    function init() {
        var optionsKlasa = {
            title: 'Łatwość całego testu w klasach',
            is3D: true,
            hAxis: {
                title: 'Klasa',
                titleTextStyle: {
                    color: '#333'
                }
            },
            vAxis: {
                title: 'Łatwość',
                minValue: 0
            },
            orientation: 'horizontal'
        };
        var dataTableKlasa = new google.visualization.DataTable();
        dataTableKlasa.addColumn('number', 'Łatwość');
        dataTableKlasa.addColumn('string', 'Klasa');
        dataTableKlasa.addRows(DANE.latwoscKlasa);
        var viewKlasa = new google.visualization.DataView(dataTableKlasa);
        viewKlasa.setColumns([1, 0]);
        var tableKlasa = new google.visualization.Table(document.getElementById('table-latwosc-klasa'));
        tableKlasa.draw(viewKlasa, {});

        var chartKlasa = new google.visualization.ColumnChart(document.getElementById('chart-latwosc-klasa'));
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