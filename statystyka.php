<?php
$servername = "localhost";
$username = "poldas";
$password = "zaq12wsx";
$dbname = "analiza";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

include("php/ante/latwoscSzkola.php");
include("php/ante/latwoscKlasa.php");
include("php/ante/sredniaPktKlasa.php");
include("php/ante/latwoscObszar.php");
?>