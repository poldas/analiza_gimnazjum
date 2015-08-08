<?php
include 'AnalizaDanychSql.php';
function debug($dane) {
    var_dump($dane);
}

abstract class AnalizaDanychCore implements AnalizaDanychSql {

    protected $dbhandler = null;
    protected $dane_db = array();
    protected $dane = array();

    public function __construct() {
        $this->dbhandler = DBconnect::connect();
        $this->przygotuj_dane();
    }

    protected function pobierz_dane_db($sql) {
        $statement = $this->dbhandler->prepare ( $sql );
        $statement->execute ();
        $dane_db = $statement->fetchAll ( PDO::FETCH_ASSOC );
        return $dane_db;
    }

    protected function koduj_json($dane) {
        return json_encode($dane);
    }

    /**
     * Mapuje dane z bazy danych do odpowiedniej architektury tablicy
     *
     * TODO; opisać jak działa mapowanie i jaka jaest architektura
     */
    protected function przygotuj_dane() {
        $dane_db = $this->pobierz_dane_db ( self::UNION_ALL_SREDNIA );
        foreach ($dane_db as $wiersz_danych) {
            $this->mapuj_dane($wiersz_danych);
        }
    }

    /**
     * TODO mapuje dane do odpowiedniej architektury tablicy
     */
    protected function mapuj_dane($wiersz_danych) {
        $klasa = $wiersz_danych['klasa'];
        $srednia = $wiersz_danych['srednia_punktow'];

        if (!is_null($wiersz_danych[self::POROWNANIE_DYSLEKSJA])) {
            $klucz = $wiersz_danych[self::POROWNANIE_DYSLEKSJA];
            $this->dane[self::POROWNANIE_DYSLEKSJA][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
                    'klasa' => $klasa
            );
        } else if (!is_null($wiersz_danych[self::POROWNANIE_LOKALIZACJA])) {
            $klucz = $wiersz_danych[self::POROWNANIE_LOKALIZACJA];
            $this->dane[self::POROWNANIE_LOKALIZACJA][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
                    'klasa' => $klasa
            );
        } else if (!is_null($wiersz_danych[self::POROWNANIE_PLEC])) {
            $klucz = $wiersz_danych[self::POROWNANIE_PLEC];
            $this->dane[self::POROWNANIE_PLEC][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
                    'klasa' => $klasa
            );
        } else {
            $klucz = 0;
            $this->dane[self::POROWNANIE_CALOSC][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
                    'klasa' => $klasa
            );
        }
    }

    protected function formatuj_do_datatable($dane_db, $konfiguracja) {
        $rows = array ();
        $table = array ();
        $table ['cols'] = $konfiguracja;

        $klucze = array_keys($dane_db);
        foreach($dane_db[$klucze[0]] as $klasa => $wiesz_danych) {
            $temp = array ();
            $temp [] = array (
                'v' => ( string ) $klasa
            );
            $temp [] = array (
                'v' => ( float ) $dane_db[$klucze[0]][$klasa]["srednia_punktow"]
            );
            if (isset($klucze[1])) {
                $temp [] = array (
                    'v' => ( float ) $dane_db[$klucze[1]][$klasa]["srednia_punktow"]
                );
            }
            $rows [] = array ('c' => $temp);
        }

        $table ['rows'] = $rows;

        return $this->koduj_json($table);
    }
}

class AnalizaDanych extends AnalizaDanychCore {

    public function pobierz_porownanie($porownanie) {
        switch ($porownanie) {
            case self::POROWNANIE_PLEC:
                return $this->pobierz_dane_porownanie_srednia_plec();
                break;
            case self::POROWNANIE_LOKALIZACJA:
                return $this->pobierz_dane_porownanie_srednia_lokalizacja();
                break;
            case self::POROWNANIE_DYSLEKSJA:
                return $this->pobierz_dane_porownanie_srednia_dysleksja();
                break;
            default:
                return $this->pobierz_dane_porownanie_srednia_calosc();
            break;
        }
    }

    public function pobierz_dane_porownanie_srednia_calosc() {
        $konfiguracja = array(
            array (
                'label' => 'Klasa',
                'type' => 'string'
            ),
            array (
                'label' => 'Średnia',
                'type' => 'number'
            )
        );
        return $this->formatuj_do_datatable($this->dane[self::POROWNANIE_CALOSC], $konfiguracja);
    }

    public function pobierz_dane_porownanie_srednia_plec() {
        $konfiguracja = array(
            array (
                'label' => 'Klasa',
                'type' => 'string'
            ),
            array (
                'label' => 'Chłopcy',
                'type' => 'number'
            ),
            array (
                'label' => 'Dziewczynki',
                'type' => 'number'
            )
        );
        return $this->formatuj_do_datatable($this->dane[self::POROWNANIE_PLEC], $konfiguracja);
    }

    public function pobierz_dane_porownanie_srednia_lokalizacja() {
        $konfiguracja = array(
            array (
                'label' => 'Klasa',
                'type' => 'string'
            ),
            array (
                'label' => 'Miasto',
                'type' => 'number'
            ),
            array (
                'label' => 'Wieś',
                'type' => 'number'
            )
        );
        return $this->formatuj_do_datatable($this->dane[self::POROWNANIE_LOKALIZACJA], $konfiguracja);
    }

    public function pobierz_dane_porownanie_srednia_dysleksja() {
        $konfiguracja = array(
            array (
                'label' => 'Klasa',
                'type' => 'string'
            ),
            array (
                'label' => 'Dysleksja',
                'type' => 'number'
            ),
            array (
                'label' => 'Bez dysleksji',
                'type' => 'number'
            )
        );
        return $this->formatuj_do_datatable($this->dane[self::POROWNANIE_DYSLEKSJA], $konfiguracja);
    }
}
?>
