<?php
include 'logika/AnalizaDanych.php';
include 'generatory/DBconnect.php';
$analiza = new AnalizaDanych();
$get = $_GET;
if (isset($get[AnalizaDanychCore::POROWNANIE_DYSLEKSJA])) {
    echo $analiza->pobierz_porownanie(AnalizaDanychCore::POROWNANIE_PLEC);
} elseif (isset($get[AnalizaDanychCore::POROWNANIE_LOKALIZACJA])) {
    echo $analiza->pobierz_porownanie(AnalizaDanychCore::POROWNANIE_LOKALIZACJA);
} elseif (isset($get[AnalizaDanychCore::POROWNANIE_DYSLEKSJA])) {
    echo $analiza->pobierz_porownanie(AnalizaDanychCore::POROWNANIE_DYSLEKSJA);
} elseif (isset($get[AnalizaDanychCore::POROWNANIE_CALOSC])) {
    echo $analiza->pobierz_porownanie(AnalizaDanychCore::POROWNANIE_CALOSC);
} else {
    echo $analiza->pobierz_porownanie(AnalizaDanychCore::POROWNANIE_CALOSC);
}
?>
