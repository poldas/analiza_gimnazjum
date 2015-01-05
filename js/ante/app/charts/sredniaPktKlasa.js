define(['goog!visualization,1,packages:[corechart,table]', 'goog!search,1'], function () {
    function init() {
        var options = {
            title: 'Średnia punktów dla klasy',
            is3D: true,
            hAxis: {
                title: 'Klasa',
                titleTextStyle: {
                    color: '#333'
                }
            },
            width: 500,
            height: 200,
            vAxis: {
                title: 'Średnia punktów',
                minValue: 0
            },
            orientation: 'horizontal'
        };
        var dataTableKlasa = new google.visualization.DataTable();
        dataTableKlasa.addColumn('string', 'Klasa');
        dataTableKlasa.addColumn('number', 'Średnia');
        dataTableKlasa.addColumn('number', 'Liczba uczniów');
        //dataTableKlasa.addColumn('number', 'Suma');

        dataTableKlasa.addRows(DANE.sredniaPktKlasa);
        //var viewKlasa = new google.visualization.DataView(dataTableKlasa);
        //viewKlasa.setColumns([0, 1]);

        var tableKlasa = new google.visualization.Table(document.getElementById('table-sredniaPkt-klasa'));
        tableKlasa.draw(dataTableKlasa, {});

        var chartKlasa = new google.visualization.ColumnChart(document.getElementById('chart-sredniaPkt-klasa'));
        chartKlasa.draw(dataTableKlasa, options);

        google.visualization.events.addListener(tableKlasa, 'sort',
            function (event) {
                dataTableKlasa.sort([{column: event.column, desc: !event.ascending}]);
                chartKlasa.draw(dataTableKlasa, options);
            }
        );
    }

    return {start: init};
});