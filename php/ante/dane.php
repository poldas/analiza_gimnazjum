<?php
include 'logika/PobierzWyniki.php';
include 'generatory/DBconnect.php';
// $analiza = new AnalizaDanych();
// $get = $_GET;
// $analiza->pobierz_porownanie($get);
$wyniki = new PobierzWyniki();
echo $wyniki->pobierz();
?>
