<?php include("statystyka.php"); ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Analiza Testów ANTE</title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>
<body>
<div id="top">
    <header id="naglowek">Analiza</header>
    <nav id="menu-nawigacyjne">
        <ul>
            <li> <a href="/import.php" >Import</a></li>
            <li> <a href="/statystyka.php" >Statystyki</a></li>
        </ul>
    </nav>
    <aside id="informacje">
        <div id="chart_div"></div>
        <div id="table_sort_div"></div>
    </aside>
    <article id="tresc">
        <div>
        - dodać biblioteki jquery bootstrap
        - zaimportować dane z dane.html i przygotować do dodania do bazy
        - przygotwać logikę do dodawania danych z formularza do bazy
        - walidator danych wysyłanych do bazy danych
        - walidator poprawności importowania danych
        - zapytania do statystyk
        - prezentacja danych w tabelkach
        - prezentacja danych w formie wykresów
        - ostylowanie wyglądu
        </div>
        <div>

        </div>
    </article>
    <footer id="stopka">Stopka serwisu</footer>
</div>
</body>
<script type="text/javascript" src="js/ante/lib/require.js" data-main="js/ante/anteconfig"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart", "table"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var dataTable = new google.visualization.DataTable();
            dataTable.addColumn('string', 'Zadanie');
            dataTable.addColumn('number', 'Łatwość');
            dataTable.addRows([
                <?php wyswietlLatwoscSzkola($latwoscSzkola); ?>
            ]);

        var options = {
            title: 'Łatwość zadań w szkole',
            hAxis: {title: 'Łatwość',  titleTextStyle: {color: '#333'}},
            vAxis: {title: 'Numer zadania', minValue: 0}
        };

        var view = new google.visualization.DataView(dataTable);
        view.setColumns([0, 1]);


        var table = new google.visualization.Table(document.getElementById('table_sort_div'));
        table.draw(view,options);

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(view, options);

        google.visualization.events.addListener(table, 'sort',
            function(event) {
                dataTable.sort([{column: event.column, desc: !event.ascending}]);
                chart.draw(view);
            }
        );
    }
</script>
</html>