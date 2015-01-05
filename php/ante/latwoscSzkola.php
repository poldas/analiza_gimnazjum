<?php
// latwosc zadan w szkole per zadanie
$latwoscSzkola = $pdo->query('SELECT
  z.numer_zadania,
  z.podzadanie,
  sum(uz.punkty) / sum(z.max_pkt) AS latwosc
FROM uczen_zadanie AS uz LEFT JOIN zadanie AS z ON z.numer_zadania = uz.numer_zadania AND z.podzadanie = uz.podzadanie
GROUP BY z.numer_zadania, z.podzadanie ORDER BY CAST(z.numer_zadania as signed), z.numer_Zadania;');
function wyswietlLatwoscSzkola($latwosc) {
    $dane = array();
    foreach ($latwosc as $row) {
        $dane[] = '['.$row['latwosc'].', '. $row['numer_zadania'].']';
    }
    echo join(',', $dane);
}
?>