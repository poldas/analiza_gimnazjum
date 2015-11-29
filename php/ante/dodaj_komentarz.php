<?php
include 'logika/PobierzWyniki.php';
include 'generatory/DBconnect.php';
$opis = strip_tags($_GET['opis']);
$czy_wyswietlac = $_GET['czy_wyswietlac'] == 'true'? 1 : 0;
$wyniki = new PobierzWyniki();
echo $wyniki->dodaj_komentarz(array(
    'id_wykresu' => $_GET['id_wykresu'],
    'opis' => $opis,
    'czy_wyswietlac' => $czy_wyswietlac,
));
?>
