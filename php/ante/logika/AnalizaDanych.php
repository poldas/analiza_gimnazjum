<?php
class AnalizaDanych {
    const SZKOLA = 'szkola';
    const KLASA = 'klasa';
    const ZAPYTANIE_WSZYSTKO = "select u.nr_ucznia,u.plec,u.dysleksja,we.klasa,we.kod_ucznia,we.nr_zadania,we.liczba_punktow,we.max_punktow,zu.nazwa_umiejetnosci,uk.umiejetnosc from wyniki_egzaminu as we left join zadanie_umiejetnosc as zu on we.nr_zadania=zu.numer_zadania left join umiejetnosc_kategoria as uk on uk.kategoria=zu.nazwa_umiejetnosci left join uczniowie as u on u.kod_ucznia=we.kod_ucznia order by we.kod_ucznia, u.nr_ucznia";
    const ZAPYTANIE_SUMA = "select sum(we.liczba_punktow) as suma_punktow, sum(we.max_punktow) as suma_max, we.klasa, we.nr_zadania
	        from wyniki_egzaminu as we
	        group by we.klasa,we.nr_zadania
	        order by we.klasa, we.nr_zadania";
    const ZAPYTANIE_SREDNIA = "select avg(we.liczba_punktow) as srednia_punktow, we.max_punktow, we.klasa, we.nr_zadania
	        from wyniki_egzaminu as we
	        group by we.nr_zadania, we.klasa
	        order by we.klasa, we.nr_zadania";
    const SQL_SUMA_SREDNIA = "
	        select
	           we.klasa,
	           avg(we.liczba_punktow) as srednia_punktow,
	           sum(we.liczba_punktow) as suma_punktow
	        from wyniki_egzaminu as we
	        group by we.klasa
	        order by we.klasa";
    private $dane_wejsciowe = array ();
    private $dane = array ();
    private $dane_json = array ();
    private $dbhandler = null;
    public function __construct($dane_wejsciowe = array()) {
        if ($dane_wejsciowe) {
            $this->ustaw_dane_wejsciowe ( $dane_wejsciowe );
        }
        $this->ustaw_db ();
    }
    public function ustaw_dane_wejsciowe($dane) {
        $this->dane_wejsciowe = $dane;
    }
    public function pobierz_dane() {
        if (! $this->dane) {
            $this->ustaw_dane ();
        }
        return $this->dane;
    }
    public function pobierz_dane_suma_srednia() {
        $dane_db = $this->pobierz_dane_db ( self::SQL_SUMA_SREDNIA );
        return $this->formatuj_dane_do_mapowania_suma_srednia ( $dane_db );
    }
    public function pobierz_dane_suma_srednia_json() {
        $dane_db = $this->pobierz_dane_db ( self::SQL_SUMA_SREDNIA );
        return $this->formatuj_do_datatable ( $dane_db );
    }
    private function formatuj_do_datatable($dane_do_formatowania) {
        $rows = array ();
        $table = array ();
        $table ['cols'] = array (

                // Labels for your chart, these represent the column titles.
                /*
                 * note that one column is in "string" format and another one is in "number" format
                 * as pie chart only required "numbers" for calculating percentage
                 * and string will be used for Slice title
                 */

                array (
                        'label' => 'Klasa',
                        'type' => 'string'
                ),
                array (
                        'label' => 'Średnia',
                        'type' => 'number'
                ),
                array (
                        'label' => 'Suma',
                        'type' => 'number'
                )
        )
        ;
        /* Extract the information from $result */
        foreach ( $dane_do_formatowania as $r ) {
            $temp = array ();

            // the following line will be used to slice the Pie chart

            $temp [] = array (
                    'v' => ( string ) $r ['klasa']
            );

            // Values of each slice

            $temp [] = array (
                    'v' => ( float ) $r ["srednia_punktow"]
            );
            $temp [] = array (
                    'v' => ( int ) $r ["suma_punktow"]
            );
            $rows [] = array (
                    'c' => $temp
            );
        }

        $table ['rows'] = $rows;

        // convert data into JSON format
        $jsonTable = json_encode ( $table );

        return $jsonTable;
    }
    private function formatuj_dane_do_mapowania_suma_srednia($dane_do_mapowania, $czy_json = false) {
        $wynik = array ();
        $wynik_json = array ();
        $element = reset ( $dane_do_mapowania );
        $klucze = array_keys ( $element );
        $wynik [] = '["' . join ( '","', $klucze ) . '"]';
        $wynik_json [] = $klucze;
        foreach ( $dane_do_mapowania as $wiersz ) {
            $tmp = array ();
            foreach ( $wiersz as $i => $wartosc ) {
                $tmp [] = $i == 'klasa' ? '"' . $wartosc . '"' : $wartosc;
            }
            $wynik_json [] = $tmp;
            $wynik [] = '[' . join ( ',', $tmp ) . ']';
        }
        if ($czy_json) {
            return json_encode ( $wynik_json );
        } else {
            return '[' . join ( ',', $wynik ) . ']';
        }
    }
    public function pobierz_dane_json() {
        if (! $this->dane) {
            $this->ustaw_dane ();
        }
        return $this->dane_json;
    }
    public function ustaw_dane() {
        // $this->dane['all'] = $this->pobierz_dane_db(self::ZAPYTANIE_WSZYSTKO);
        $this->pobierz_srednia ();
        $this->dane_json = $this->mapuj_do_datatable ( $this->dane [self::SZKOLA] );
    }
    protected function mapuj_do_datatable($dane_do_mapowania) {
        $dane_zmapowane = $wynik = $tmp = array ();
        list ( $dane_zmapowane, $liczba_zadan ) = $this->formatuj_dane_do_mapowania ( $dane_do_mapowania );
        // formowanie nagłówka datatable
        $tmp [0] = '"klasa"';
        for($i = 1; $i <= $liczba_zadan; $i ++) {
            $tmp [$i] = '"zad' . $i . '"';
        }
        $wynik [] = '[' . join ( ',', $tmp ) . ']';

        // formatowanie reszty rekordów datatable
        foreach ( $dane_zmapowane as $klasa => $punkty_za_zadania ) {
            $tmp = array ();
            $tmp [0] = '"' . $klasa . '"';
            foreach ( $punkty_za_zadania as $nr_zadania => $tablica_punktow ) {
                $tmp [$nr_zadania] = $tablica_punktow ['suma'];
            }
            $wynik [] = '[' . join ( ',', $tmp ) . ']';
        }
        return join ( ',', $wynik );
    }
    private function formatuj_dane_do_mapowania($dane_do_mapowania) {
        $wynik = array ();
        $numery_zadan = array ();
        foreach ( $dane_do_mapowania as $wiersz ) {
            $numery_zadan [$wiersz ['nr_zadania']] = 1;
            $wynik [$wiersz ['klasa']] [$wiersz ['nr_zadania']] ['suma'] = $wiersz ['suma_punktow'];
            // $wynik[$wiersz['klasa'].'max'][$wiersz['nr_zadania']]['suma'] = $wiersz['suma_max'];
        }

        return array (
                $wynik,
                count ( array_keys ( $numery_zadan ) )
        );
    }
    public function drukuj() {
        print_r ( $this->pobierz_dane () );
    }
    public function pobierz_srednia() {
        $this->dane [self::SZKOLA] = $this->pobierz_dane_db ( self::ZAPYTANIE_SUMA );
        $this->dane [self::KLASA] = $this->pobierz_dane_db ( self::ZAPYTANIE_SREDNIA );
    }
    private function ustaw_db() {
        $this->dbhandler = DBconnect::connect ();
    }
    private function pobierz_dane_db($sql) {
        $statement = $this->dbhandler->prepare ( $sql );
        $statement->execute ();
        $dane_db = $statement->fetchAll ( PDO::FETCH_ASSOC );
        return $dane_db;
    }
}
class DataTable {
    private $dane_db = array ();
    private $table = array ();
    public function ustaw_formater($formater) {
    }
    private function mapuj_dane($dane_db) {
        /* Extract the information from $result */
        $rows = array ();
        foreach ( $dane_db as $r ) {
            $temp = array ();

            // the following line will be used to slice the Pie chart

            $temp [] = array (
                    'v' => ( string ) $r ['klasa']
            );

            // Values of each slice

            $temp [] = array (
                    'v' => ( float ) $r ["srednia_punktow"]
            );
            $temp [] = array (
                    'v' => ( int ) $r ["suma_punktow"]
            );
            $rows [] = array (
                    'c' => $temp
            );
        }

        $this->addrow ( $rows );

        // convert data into JSON format
        $jsonTable = json_encode ( $this->table );

        return $jsonTable;
    }
    private $data;
    private function addrow($row) {
        $this->table ['rows'] = $row;
    }
    public function addColumn($label, $type = 'number') {
        $this->table ['cols'] [] = array (
                'label' => $label,
                'type' => $type
        );
    }
    public function getDataTable() {
        return join ( ',', $this->data );
    }
    public function ustaw_dane_db($dane_db) {
        $this->dane_db = $dane_db;
    }
}
?>
