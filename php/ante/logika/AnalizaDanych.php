<?php
class AnalizaDanych {

    const SQL_SREDNIA_PLEC = "
        select
            avg(we.iczba_punktow) as we.srednia_punktow,
            u.plec
        from wyniki_egzaminu as we
        left join uczniowie as u
            on u.kod_ucznia = we.kod_ucznia
        group by u.plec
    ";

    const SQL_SREDNIA_DYSLEKSJA = "
        select
            avg(we.liczba_punktow) as we.srednia_punktow,
            u.dysleksja
        from wyniki_egzaminu as we
        left join uczniowie as u
            on u.kod_ucznia = we.kod_ucznia
        group by u.dysleksja
    ";

    const SQL_SREDNIA_MIEJSCOWOSC = "
        select
            avg(we.liczba_punktow) as we.srednia_punktow,
            u.miejscowosc
        from wyniki_egzaminu as we
        left join uczniowie as u
            on u.kod_ucznia = we.kod_ucznia
        group by u.miejscowosc
    ";

    const SQL_SREDNIA_SZKOLA = "
        select avg(liczba_punktow) as srednia_punktow from wyniki_egzaminu
    ";

    const SQL_SREDNIA_KLASA = "
        select
            we.klasa,
            avg(we.liczba_punktow) as srednia_punktow
        from wyniki_egzaminu as we
        group by we.klasa
        order by we.klasa
    ";

    const SQL_SUMA_SREDNIA = "
        select
           we.klasa,
           avg(we.liczba_punktow) as srednia_punktow,
           sum(we.liczba_punktow) as suma_punktow
        from wyniki_egzaminu as we
        group by we.klasa
        order by we.klasa
    ";

    const SQL_LATWOSC_KLASA_ZADANIE = "
        select
            we.klasa,
            we.nr_zadania,
            avg(we.liczba_punktow)/we.max_punktow as latwosc
        from wyniki_egzaminu as we
        group by we.nr_zadania, we.klasa
    ";

    const SQL_LATWOSC_SZKOLA_ZADANIE = "
        select
            we.nr_zadania,
            avg(we.liczba_punktow)/we.max_punktow as latwosc
        from wyniki_egzaminu as we
        group by we.nr_zadania
    ";

    const SQL_LATWOSC_SZKOLA_MIEJSCOWOSC = "
        select
            we.nr_zadania,
            avg(we.liczba_punktow) as we.srednia_punktow,
            u.miejscowosc
        from wyniki_egzaminu as we
        left join uczniowie as u
            on u.kod_ucznia = we.kod_ucznia
        group by we.nr_zadania, u.miejscowosc
    ";

    const SQL_LATWOSC_SZKOLA_DYSLEKSJA  = "
        select
            we.nr_zadania,
            avg(we.liczba_punktow) as we.srednia_punktow,
            u.dysleksja
        from wyniki_egzaminu as we
        left join uczniowie as u
            on u.kod_ucznia = we.kod_ucznia
        group by we.nr_zadania, u.dysleksja
    ";

    const SQL_LATWOSC_SZKOLA_PLEC = "
        select
            we.nr_zadania,
            avg(we.liczba_punktow) as we.srednia_punktow,
            u.plec
        from wyniki_egzaminu as we
        left join uczniowie as u
            on u.kod_ucznia = we.kod_ucznia
        group by we.nr_zadania, u.plec
    ";

    const SQL_UNION_DYSLEKSJA = "select avg(we.liczba_punktow) as srednia_punktow, u.dysleksja, 0 miasto, 0 plec, 'szkola' klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.dysleksja";
    const SQL_UNION_MIEJSCOWOSC = "select avg(we.liczba_punktow) as srednia_punktow, 0 dysleksja, u.miejscowosc, 0 plec, 'szkola' klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.miejscowosc";
    const SQL_UNION_PLEC = "select avg(we.liczba_punktow) as srednia_punktow, 0 dysleksja, 0 miasto, u.plec, 'szkola' klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.plec";

    const UNION_SZKOLA = "select avg(we.liczba_punktow) as srednia_punktow, u.dysleksja, 0 miejscowosc, 0 plec, 'szkola' klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.dysleksja UNION select avg(we.liczba_punktow) as srednia_punktow, 0 dysleksja, u.miejscowosc, 0 plec, 'szkola' klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.miejscowosc UNION select avg(we.liczba_punktow) as srednia_punktow, 0 dysleksja, 0 miejscowosc, u.plec, 'szkola' klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.plec";
    const UNION_KLASA = "select avg(we.liczba_punktow) as srednia_punktow, u.dysleksja, 0 miejscowosc, 0 plec, we.klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.dysleksja, we.klasa UNION select avg(we.liczba_punktow) as srednia_punktow, 0 dysleksja, u.miejscowosc, 0 plec, we.klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.miejscowosc,we.klasa UNION select avg(we.liczba_punktow) as srednia_punktow, 0 dysleksja, 0 miejscowosc, u.plec, we.klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.plec, we.klasa";
    const UNION_ALL_SREDNIA = "select avg(we.liczba_punktow) as srednia_punktow, u.dysleksja, 0 miejscowosc, 0 plec, 'szkola' klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.dysleksja UNION select avg(we.liczba_punktow) as srednia_punktow, 0 dysleksja, u.miejscowosc, 0 plec, 'szkola' klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.miejscowosc UNION select avg(we.liczba_punktow) as srednia_punktow, 0 dysleksja, 0 miejscowosc, u.plec, 'szkola' klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.plec UNION select avg(we.liczba_punktow) as srednia_punktow, u.dysleksja, 0 miejscowosc, 0 plec, we.klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.dysleksja, we.klasa UNION select avg(we.liczba_punktow) as srednia_punktow, 0 dysleksja, u.miejscowosc, 0 plec, we.klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.miejscowosc,we.klasa UNION select avg(we.liczba_punktow) as srednia_punktow, 0 dysleksja, 0 miejscowosc, u.plec, we.klasa from wyniki_egzaminu as we left join uczniowie as u on u.kod_ucznia = we.kod_ucznia GROUP BY u.plec, we.klasa";

    private $dbhandler = null;

    public function __construct() {
        $this->ustaw_db ();
    }



    public function pobierz_dane_suma_srednia_json() {
        $dane_db = $this->pobierz_dane_db ( self::SQL_SUMA_SREDNIA );
        return $this->formatuj_do_datatable ( $dane_db, 'suma-srednia');
    }

    public function pobierz_dane_latwosc_klasa_zadanie_json() {
        $dane_db = $this->pobierz_dane_db ( self::SQL_LATWOSC_KLASA_ZADANIE );
        return $this->formatuj_do_datatable ( $dane_db, 'latwosc-klasa-zadanie');
    }


    public function pobierz_srednia() {
        // średnia pkt szkola
        // średnia pkt w klasach
        // średnia pkt szkola plec
        // średnia pkt szkola miasto
        // średnia pkt szkola dysleksja
        // średnia pkt klasach plec
        // średnia pkt klasach miasto
        // średnia pkt klasach dysleksja
        // UNION_ALL_SREDNIA
    }





    private function formatuj_do_datatable($dane_db, $formater = 'suma-srednia') {
        $czy_wysylac = false;
        if ($formater == 'suma-srednia') {
            $table = $this->formater_suma_srednia($dane_db);
            $czy_wysylac = true;
        }
        if ($formater == 'latwosc-klasa-zadanie') {
            $table = $this->formater_latwosc_klasa_zadanie($dane_db);
            $czy_wysylac = true;
        }
        if ($czy_wysylac) {
            // convert data into JSON format
            $jsonTable = json_encode ( $table );

            return $jsonTable;
        }
    }

    private function formater_latwosc_klasa_zadanie($dane_db) {
        $rows = array ();
        $table = array ();
        $table ['cols'] = array (
                array (
                        'label' => 'Klasa',
                        'type' => 'string'
                ),
                array (
                        'label' => 'Nr zadania',
                        'type' => 'number'
                ),
                array (
                        'label' => 'Łatwość',
                        'type' => 'number'
                )
        );
        foreach ( $dane_db as $r ) {
            $temp = array ();
            $temp [] = array (
                    'v' => ( string ) $r ['klasa']
            );
            $temp [] = array (
                    'v' => ( float ) $r ["nr_zadania"]
            );
            $temp [] = array (
                    'v' => ( int ) $r ["latwosc"]
            );
            $rows [] = array ('c' => $temp);
        }

        $table ['rows'] = $rows;

        return $table;
    }

    private function formater_suma_srednia($dane_db) {
        $rows = array ();
        $table = array ();
        $table ['cols'] = array (
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
        );
        foreach ( $dane_db as $r ) {
            $temp = array ();
            $temp [] = array (
                    'v' => ( string ) $r ['klasa']
            );
            $temp [] = array (
                    'v' => ( float ) $r ["srednia_punktow"]
            );
            $temp [] = array (
                    'v' => ( int ) $r ["suma_punktow"]
            );
            $rows [] = array ('c' => $temp);
        }

        $table ['rows'] = $rows;

        return $table;
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
    private $formater = null;

    public function ustaw_formater($formater) {
        $this->formater = $formater;
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
    public function ustaw_dane_db($dane_db) {
        $this->dane_db = $dane_db;
    }
}
?>
