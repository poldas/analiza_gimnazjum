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
$generator = new GeneratorBuilder('../../dane/wyniki_egzaminu.csv');
// $generator->generuj_zapytanie_sql();
// $generator->dodaj_wpis($generator->pobierz_sql());
// $generator->drukuj_sql();

$analiza = new AnalizaDanych();
// $analiza->drukuj();
?>
</pre>
KONIEC test.php