<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Google Visualization API Sample</title>
</head>
<body>
  <div id="app-view">
    <div id="nav-view">
  </div>
  <div id="content-view">
  <pre>
  select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                we.nr_zadania,
                null dysleksja,
                null lokalizacja,
                null plec,
                'szkola' klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            left join obszary as o
                on o.nr_zadania = we.nr_zadania
            where o.obszar='I'
             GROUP by we.nr_zadania
  <?php
include 'logika/AnalizaDanych.php';
include 'generatory/DBconnect.php';
$analiza = new AnalizaDanych();
$get = $_GET;
$analiza->pobierz_porownanie($get);
?>
</pre>
  </div>
  </div>
  <script type="text/javascript"></script>
</body>
</html>