START test.php
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
$generator = new GeneratorBuilder();
$generator->ustaw_zrodlo_danych('../../dane/wyniki.csv');
$generator->generuj_zapytanie_sql();
$generator->ustaw_zrodlo_danych_uczniowie('../../dane/uczniowie.csv');
$generator->generuj_zapytanie_sql_uczniowie();
// $generator->dodaj_dane_automatycznie();
// $generator->dodaj_wpis($generator->pobierz_sql());
// $generator->dodaj_wpis($generator->pobierz_sql_uczniowie());

?>
</pre>
KONIEC test.php