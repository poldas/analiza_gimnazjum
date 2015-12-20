START test.php
<pre>
<?php
ini_set ( 'display_errors', '1' );
function autoloader($nazwa_klasy) {
	if (file_exists ( 'generatory/' . $nazwa_klasy . '.php' ))
		require ('generatory/' . $nazwa_klasy . '.php');
	if (file_exists ( 'logika/' . $nazwa_klasy . '.php' )) {
		require ('logika/' . $nazwa_klasy . '.php');
	}
}
spl_autoload_register('autoloader');
$generator = new GeneratorBuilder();
$nazwa_pliku_danych = isset($_GET['name'])? $_GET['name'] : "";
if (!$nazwa_pliku_danych) {
echo "nie ma danych podaj nazwę pliku w name=<nazwa pliku> w katalogu dane";
return;
}
$generator->ustaw_zrodlo_danych('../../dane/'.$nazwa_pliku_danych);
$generator->generuj_zapytanie_sql();
echo "wygenerowane";
if (isset($_GET['dodaj'])) {
 $generator->dodaj_dane_automatycznie();
echo "dodane do bazy";
}

?>
</pre>
KONIEC test.php
