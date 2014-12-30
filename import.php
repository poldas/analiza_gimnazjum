<?php
include('simple_html_dom.php');
$html = file_get_html("dane/data");

// znajduje wszystkie elementy tr
$trElem = $html->find('tr');

// pierwszy element w tablicy $trElem to numer zadania
$zadania = array_shift($trElem);
// drugi element w tablicy $trElem to obszary/umiejetnosci
$obszary = array_shift($trElem);

// znajduje konkretne elementy do wyciagania danych
$pZadania = $zadania->find('td p');
$pObszary = $obszary->find('td p');

// liczba zadan
$iloscZadan = count($pZadania);
echo "<h2> ilosc zadan ".$iloscZadan."</h2>";

$sqlTab = array();

// przygotowuje tablice danych do zadan
$sqlPrefix = "INSERT INTO `zadanie` (`numer_zadania`, `max_pkt`, `podzadanie`) VALUES ";
$zadania = array();
foreach($pZadania as $id => $p) {
    $numer_zadania = $p->plaintext;
    $zadania[$id] = array(
        'id' => $id,
        'id_zadania' => $id + 1,
        'numer_zadania' => $numer_zadania,
        'max_pkt' => 1,
        'uzyskane_pkt' => 0,
    );
    $sqlTab[] = "('".$numer_zadania."', 1, 1)";
}
$sql = $sqlPrefix.join(', ', $sqlTab).";";
echo $sql;

// usuwa niepotrzebne elementy z konca
array_pop($trElem);
array_pop($trElem);

// przygotowuje tablice danych dla obszarow
//$obszary = array();
//foreach($pObszary as $id => $p) {
//    $wiersz = $p->plaintext;
//
//    $obszary[$id] = array(
//        'obszar' => $obszar,
//        'umiejetnosc' => $umiejetnosc
//    );
//}

echo '<br>';
// $trElem jest tablica danych z czystymi danymi do sparsowania
$oceny = array();
$uczniowie = array();
$iloscOcen = count($trElem);
echo "<h2>ilosc wierszy ".$iloscOcen."</h2>";
$i = 0;
$sqlUczenPrefix = "INSERT INTO `uczen` (`kod`, `typ_miasta`, `plec`, `klasa`, `numer`, `rodzaj_choroby`) VALUES ";
$sqlUczenTab = array();
foreach($trElem as $idTtr => $tr) {

    $sqlUczenZadaniePrefix = "INSERT INTO `uczen_zadanie` (`kod_ucznia`, `numer_zadania`, `punkty`, `podzadanie`) VALUES ";

    // elementy p danego wiersza tr
    $pElem = $tr->find('p');

    // pierwszy element to kod ucznia
    $nrUczEle = array_shift($pElem);
    $kod_ucznia = $nrUczEle->plaintext;

    // przygotowuje tablice uczniow
    $uczniowie[$kod_ucznia] = array(
        'kod_ucznia' => $kod_ucznia,
        'klasa' => preg_replace('/\d/', '', $kod_ucznia),
        'numer_ucznia' =>  preg_replace('/[^0-9]/', '', $kod_ucznia),
        'rodzaj_miejscowosci' => 'miasto',
        'plec' => 'm',
        'czy_dysleksja' => 0,
    );

    $sqlUczenTab[] = "('".$kod_ucznia."', 'miasto', 'm', '".preg_replace('/\d/', '', $kod_ucznia)."', '".preg_replace('/[^0-9]/', '', $kod_ucznia)."', 0)";
    $sqlTab = array();
    // przygotowuje oceny danego ucznia
    foreach($pElem as $id => $p) {
        $uzyskane_pkt = $p->plaintext;
        $id_zadania = $id % $iloscZadan;
        $nazwa_zadania = $zadania[$id_zadania]['numer_zadania'];
        $oceny[$i++] = array(
            'nazwa_zadania' => $nazwa_zadania,
            'uzyskane_pkt' => $uzyskane_pkt,
            'kod_ucznia' => $kod_ucznia,
            'podzadanie' => 1
        );
        $sqlTab[] = "('".$kod_ucznia."', '".$nazwa_zadania."', ".$uzyskane_pkt.", 1)";
    }

    $sql = $sqlUczenZadaniePrefix.join(', ', $sqlTab).";";
    echo $sql."<br>";
}
echo "ilosc ocen ".count($oceny)."<br>";
$sql = $sqlUczenPrefix.join(', ', $sqlUczenTab).";";
echo $sql."<br>";
echo '<pre>';
var_dump($oceny);
echo '</pre>';



?>
