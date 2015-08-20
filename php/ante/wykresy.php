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
$analiza->pobierz_porownanie($get);
?>
</pre>
  </div>
  </div>
  <script type="text/javascript"></script>
</body>
</html>