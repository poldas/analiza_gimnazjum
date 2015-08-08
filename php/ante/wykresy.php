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
  <?php
include 'logika/AnalizaDanych.php';
include 'generatory/DBconnect.php';
$analiza = new AnalizaDanych();
$get = $_GET;
if (isset($get[AnalizaDanychCore::POROWNANIE_PLEC])) {
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
</pre>
  </div>
  </div>
  <script type="text/javascript"></script>
</body>
</html>