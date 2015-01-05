<?php
// latwosc testu calego per klasa
$latwoscKlasa = $pdo->query('
SELECT
  u.klasa,
  sum(uz.punkty) / sum(z.max_pkt) AS latwosc
FROM uczen_zadanie AS uz LEFT JOIN zadanie AS z ON z.numer_zadania = uz.numer_zadania AND z.podzadanie = uz.podzadanie
  LEFT JOIN uczen AS u ON u.kod = uz.kod_ucznia
GROUP BY u.klasa;');

function wyswietlLatwoscKlasa($latwosc)
{
    $dane = array();
    foreach ($latwosc as $row) {
        $dane[] = '['.$row['latwosc'].', "'. $row['klasa'].'"]';
    }
    echo join(',', $dane);
}
?>