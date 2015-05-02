START test.php
<div id="chart_div"></div>
<div id="chart_div_suma_srednia"></div>
<div id="chart_div_zdania"></div>
<pre>
<?php
ini_set('display_errors','1');
function autoloader($nazwa_klasy) {
    if (file_exists('generatory/'.$nazwa_klasy.'.php'))
	   require('generatory/'.$nazwa_klasy.'.php');
    if (file_exists('logika/'.$nazwa_klasy.'.php')){
        require('logika/'.$nazwa_klasy.'.php');
    }
}
spl_autoload_register('autoloader');
$generator = new GeneratorBuilder('../../dane/wyniki_egzaminu.csv');
// $generator->generuj_zapytanie_sql();
// $generator->dodaj_wpis($generator->pobierz_sql());
// $generator->drukuj_sql();

$analiza = new AnalizaDanych();
$analiza->pobierz_dane();
// $analiza->drukuj();
?>
</pre>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
      google.load('visualization', '1.1', {
          packages:['corechart', 'bar']
      });
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data_zadania = google.visualization.arrayToDataTable(
                [<?php echo $analiza->pobierz_dane_json();?>]
            );
        var data_suma_srednia = google.visualization.arrayToDataTable(
                [<?php echo $analiza->pobierz_dane_suma_srednia();?>]
            );
        var options_suma_srednia = {
                width: 900,
                height:900,
                chart: {
                  title: 'Wykres sumy i średniej punktów w klasie',
                  subtitle: 'Średnia i suma'
                },
                series: {
                  0: { axis: 'srednia' }, // Bind series 0 to an axis named 'distance'.
                  1: { axis: 'suma' } // Bind series 1 to an axis named 'brightness'.
                },
                axes: {
                  y: {
                	  srednia: {label: 'Średnia'}, // Left y-axis.
                	  suma: {side: 'right', label: 'Suma punktów'} // Right y-axis.
                  }
                }
              };
        var options_zadania = {
    		chart: {
                title: 'Zadania'
              }
        };
        var chart_zadania = new google.visualization.ColumnChart(document.getElementById('chart_div_zdania'));
        var chart_suma_srednia = new google.charts.Bar(document.getElementById('chart_div_suma_srednia'));

        chart_zadania.draw(data_zadania, options_zadania);
        chart_suma_srednia.draw(data_suma_srednia, options_suma_srednia);
      }
    </script>
KONIEC test.php