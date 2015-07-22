<?php
include 'logika/AnalizaDanych.php';
include 'generatory/DBconnect.php';
$analiza = new AnalizaDanych();
echo $analiza->pobierz_dane_suma_srednia_json();
// echo $analiza->pobierz_dane_latwosc_klasa_zadanie_json();
?>