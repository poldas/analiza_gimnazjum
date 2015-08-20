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
// $generator->ustaw_zrodlo_danych('../../dane/Dane dla Daniela kl II 2015l.csv');
$generator->ustaw_zrodlo_danych('../../dane/Dane egz 2015 dla Daniela.csv');
$generator->generuj_zapytanie_sql();
// $generator->dodaj_dane_automatycznie();

?>
</pre>
KONIEC test.php