<?php
include 'logika/AnalizaDanych.php';
include 'generatory/DBconnect.php';
$analiza = new AnalizaDanych();
$get = $_GET;
$analiza->porownanie($get);
?>
