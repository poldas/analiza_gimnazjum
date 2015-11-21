<?php
include 'logika/PobierzWyniki.php';
include 'generatory/DBconnect.php';
// $analiza = new AnalizaDanych();
// $get = $_GET;
// $analiza->pobierz_porownanie($get);
$wyniki = new PobierzWyniki();
if(!empty($_GET['id_wykresu']) && !empty($_GET['opis'])) {
    echo $wyniki->dodaj_komentarz(array(
        'id_wykresu' => $_GET['id_wykresu'],
        'opis' => strip_tags($_GET['opis'])
    ));
}
?>
