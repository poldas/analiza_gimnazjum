<?php
// latwosc per obszar, umiejetnosc, klasa
$latwoscObszar = $pdo->query('
SELECT ou.obszar,ou.umiejetnosc, u.klasa,sum(uz.punkty)/sum(z.max_pkt) AS latwosc
FROM obszar_umiejetnosc as ou LEFT JOIN zadanie_obszar_umie AS zou ON zou.id_obszar_umiej = ou.id
  LEFT JOIN uczen_zadanie AS uz ON uz.numer_zadania = zou.numer_zadania
  LEFT JOIN zadanie AS z ON z.numer_zadania = zou.numer_zadania
  LEFT JOIN uczen AS u ON u.kod = uz.kod_ucznia
  GROUP BY ou.obszar,ou.umiejetnosc, u.klasa
  ORDER BY ou.obszar, CAST(ou.umiejetnosc as signed), ou.umiejetnosc, u.klasa;');

function wyswietlLatwoscObszar($latwosc)
{
    $dane = array();
    foreach ($latwosc as $row) {
        $dane[] = '["'.$row['obszar'].'/'.$row['umiejetnosc'].'",'.floatval($row['latwosc']).']';
    }
    echo join(',', $dane);
}
?>