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


// latwosc zadan w szkole per zadanie
$latwoscSzkola = $pdo->query('SELECT
  z.numer_zadania,
  z.podzadanie,
  sum(uz.punkty) / sum(z.max_pkt) AS latwosc
FROM uczen_zadanie AS uz LEFT JOIN zadanie AS z ON z.numer_zadania = uz.numer_zadania AND z.podzadanie = uz.podzadanie
GROUP BY z.numer_zadania, z.podzadanie ORDER BY CAST(z.numer_zadania as signed), z.numer_Zadania;');
function wyswietlLatwoscSzkola($latwosc)
{
    $dane = array();
    foreach ($latwosc as $row) {
        $dane[] = '["' . $row['numer_zadania'] . '", ' . $row['latwosc'] . ']';
    }
    echo join(',', $dane);
}

?>

