<?php
$sredniaPktKlasa = $pdo->query('
SELECT
  u.klasa,
  sum(uz.punkty) / count(DISTINCT u.numer) AS srednia, count(DISTINCT u.numer) AS liczba_uczniow, sum(uz.punkty) AS suma_punkow,
  sum(uz.punkty) / sum(z.max_pkt) AS latwosc
FROM uczen_zadanie AS uz LEFT JOIN zadanie AS z ON z.numer_zadania = uz.numer_zadania AND z.podzadanie = uz.podzadanie
  LEFT JOIN uczen AS u ON u.kod = uz.kod_ucznia
GROUP BY u.klasa;');

function wyswietlSredniaPktKlasa($latwosc)
{
    $dane = array();
//    $dane[] = '["Klasa", "Średnia", "Liczba uczniów", "Suma punktów"]';
    $dane[] = '["Klasa", "Średnia", "Łatwość"]';
    foreach ($latwosc as $row) {
//        $dane[] = '["'.$row['klasa'].'", '. $row['srednia'].', '. $row['liczba_uczniow'].', '. $row['suma_punkow'].']';
        $dane[] = '["'.$row['klasa'].'", '. $row['srednia'].', '. $row['latwosc'].']';//, '. $row['suma_punkow'].']';
    }
    echo join(',', $dane);
}
?>