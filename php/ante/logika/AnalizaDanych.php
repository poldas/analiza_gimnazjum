<?php
include 'AnalizaDanychSql.php';
abstract class AnalizaDanychCore implements AnalizaDanychSql {

    protected $dbhandler = null;
    protected $dane_db = array();
    protected $dane = array();
    protected $dane_zadania = array();
    protected $dane_obszar = array();

    public function __construct() {
        $this->dbhandler = DBconnect::connect();
        $this->przygotuj_dane();
        $this->przygotuj_dane_zadania();
        $this->przygotuj_dane_obszar();
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
     * pola: plec, klasa, lokalizacja, dysleksja
     *
     * TODO; opisać jak działa mapowanie i jaka jaest architektura
     */
    protected function przygotuj_dane() {
        $dane_db = $this->pobierz_dane_db ( self::UNION_ALL_SREDNIA );
        foreach ($dane_db as $wiersz_danych) {
            $this->mapuj_dane($wiersz_danych);
        }
    }

    protected function przygotuj_dane_zadania() {
        $dane_db = $this->pobierz_dane_db ( self::UNION_ALL_SREDNIA_ZADANIA );
        foreach ($dane_db as $wiersz_danych) {
            $this->mapuj_dane_zadania($wiersz_danych);
        }
    }

    /**
     * TODO mapuje dane do odpowiedniej architektury tablicy
     */
    protected function mapuj_dane_zadania($wiersz_danych) {
        $klasa = $wiersz_danych['klasa'];
        $srednia = $wiersz_danych['srednia_punktow'];
        $nr_zadania = $wiersz_danych['nr_zadania'];

        // $klucz określa jaką watość ma dane porównanie np lokalizacja m,w, płeć, c,d, dyslekcja 0,1
        if (!is_null($wiersz_danych[self::POROWNANIE_DYSLEKSJA])) {
            $klucz = $wiersz_danych[self::POROWNANIE_DYSLEKSJA];
            $this->dane_zadania[$nr_zadania][self::POROWNANIE_DYSLEKSJA][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
                    'klasa' => $klasa
            );
        } else if (!is_null($wiersz_danych[self::POROWNANIE_LOKALIZACJA])) {
            $klucz = $wiersz_danych[self::POROWNANIE_LOKALIZACJA];
            $this->dane_zadania[$nr_zadania][self::POROWNANIE_LOKALIZACJA][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
                    'klasa' => $klasa
            );
        } else if (!is_null($wiersz_danych[self::POROWNANIE_PLEC])) {
            $klucz = $wiersz_danych[self::POROWNANIE_PLEC];
            $this->dane_zadania[$nr_zadania][self::POROWNANIE_PLEC][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
                    'klasa' => $klasa
            );
        } else {
            $klucz = 0; // całość danych nie ma porównania, dlatego wszystko znajduje się w pod kluczem
            $this->dane_zadania[$nr_zadania][self::POROWNANIE_CALOSC][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
                    'klasa' => $klasa
            );
        }
    }
    protected function przygotuj_dane_obszar() {
        $dane_db = $this->pobierz_dane_db ( self::UNION_ALL_SREDNIA_OBSZAR_UMIEJETNOSC );
        foreach ($dane_db as $wiersz_danych) {
            $this->mapuj_dane_obszar($wiersz_danych);
        }
    }

    protected function mapuj_dane_obszar($wiersz_danych) {
        $klasa = $wiersz_danych['klasa'];
        $srednia = $wiersz_danych['srednia_punktow'];
        $obszar = $wiersz_danych['obszar'];
        $umiejetnosc = !is_null($wiersz_danych['umiejetnosc']) ? $wiersz_danych['umiejetnosc'] : 'calosc';

        // $klucz określa jaką watość ma dane porównanie np lokalizacja m,w, płeć, c,d, dyslekcja 0,1
        if (!is_null($wiersz_danych[self::POROWNANIE_DYSLEKSJA])) {
            $klucz = $wiersz_danych[self::POROWNANIE_DYSLEKSJA];
            $this->dane_obszar[$obszar][$umiejetnosc][self::POROWNANIE_DYSLEKSJA][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
                    'klasa' => $klasa
            );
        } else if (!is_null($wiersz_danych[self::POROWNANIE_LOKALIZACJA])) {
            $klucz = $wiersz_danych[self::POROWNANIE_LOKALIZACJA];
            $this->dane_obszar[$obszar][$umiejetnosc][self::POROWNANIE_LOKALIZACJA][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
                    'klasa' => $klasa
            );
        } else if (!is_null($wiersz_danych[self::POROWNANIE_PLEC])) {
            $klucz = $wiersz_danych[self::POROWNANIE_PLEC];
            $this->dane_obszar[$obszar][$umiejetnosc][self::POROWNANIE_PLEC][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
                    'klasa' => $klasa
            );
        } else {
            $klucz = 0; // całość danych nie ma porównania, dlatego wszystko znajduje się w pod kluczem
            $this->dane_obszar[$obszar][$umiejetnosc][self::POROWNANIE_CALOSC][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
                    'klasa' => $klasa
            );
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

    protected function formatuj_do_datatable($rodzaj_danych, $konfiguracja) {
        $rows = array ();
        $table = array ();
        $dane_db = $this->dane[$rodzaj_danych];
        $klucze = array_keys($dane_db);


        $table ['cols'] = $konfiguracja;
        foreach($dane_db[$klucze[0]] as $klasa => $wiesz_danych) {
            $temp = array ();
            $temp [] = array (
                'v' => ( string ) $klasa
            );
            $temp [] = array (
                'v' => ( float ) $dane_db[$klucze[0]][$klasa]["srednia_punktow"]
            );
            // jeżeli jest drugi klucz (np. porównanie chłopcy dziewczynki)
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

    protected function formatuj_do_datatable_obszar($konfiguracja, $konfig) {
     $rows = array ();
        $table = array ();
        $obszar = $konfig['obszar'];
        $umiejetnosci = array_keys($this->dane_obszar[$obszar]);
        $rodzaj_danych = $konfig['rodzaj_danych'];
        $klasa = $konfig['klasa'];

        $table ['cols'] = $konfiguracja;
        foreach($umiejetnosci as $umiejetnosc) {
            $wiersz_zadanie = $this->dane_obszar[$obszar][$umiejetnosc][$rodzaj_danych];
            $klucze = array_keys($wiersz_zadanie);

            $temp = array();
            $temp[] = array(
                    'v' => ( string ) $umiejetnosc
            );
            $temp[] = array(
                'v' => ( float ) $wiersz_zadanie[$klucze[0]][$klasa]["srednia_punktow"]
            );
            // jeżeli jest drugi klucz (np. porównanie chłopcy dziewczynki)
            if (isset ( $klucze[1] )) {
                $temp[] = array(
                    'v' => ( float ) $wiersz_zadanie[$klucze[1]][$klasa]["srednia_punktow"]
                );
            }
            $rows[] = array(
                'c' => $temp
            );
        }

        $table ['rows'] = $rows;

        return $this->koduj_json($table);
    }

    protected function formatuj_do_datatable_zadania($rodzaj_danych, $konfiguracja, $konfig) {
        $rows = array ();
        $table = array ();
        $zadania = array_keys($this->dane_zadania);
        $klasa = $konfig['klasa'];
        natsort($zadania);

        $table ['cols'] = $konfiguracja;
        foreach($zadania as $zadanie) {
            $wiersz_zadanie = $this->dane_zadania[$zadanie][$konfig['rodzaj_danych']];
            $klucze = array_keys($wiersz_zadanie);

            $temp = array();
            $temp[] = array(
                    'v' => ( string ) $zadanie
            );
            $temp[] = array(
                'v' => ( float ) $wiersz_zadanie[$klucze[0]][$klasa]["srednia_punktow"]
            );
            // jeżeli jest drugi klucz (np. porównanie chłopcy dziewczynki)
            if (isset ( $klucze[1] )) {
                $temp[] = array(
                    'v' => ( float ) $wiersz_zadanie[$klucze[1]][$klasa]["srednia_punktow"]
                );
            }
            $rows[] = array(
                'c' => $temp
            );
        }

        $table ['rows'] = $rows;

        return $this->koduj_json($table);
    }
}

class AnalizaDanych extends AnalizaDanychCore {

    protected function _pobierz_porownanie($porownanie, $konfiguracja = array()) {
        switch ($porownanie) {
            case self::POROWNANIE_PLEC:
                return $this->pobierz_dane_porownanie_srednia_plec($konfiguracja);
                break;
            case self::POROWNANIE_LOKALIZACJA:
                return $this->pobierz_dane_porownanie_srednia_lokalizacja($konfiguracja);
                break;
            case self::POROWNANIE_DYSLEKSJA:
                return $this->pobierz_dane_porownanie_srednia_dysleksja($konfiguracja);
                break;
            case self::POROWNANIE_ZADANIA:
                return $this->pobierz_dane_porownanie_srednia_zadania($konfiguracja);
                break;
            case self::POROWNANIE_OBSZAR:
                return $this->pobierz_dane_porownanie_srednia_obszar($konfiguracja);
                break;
            default:
                return $this->pobierz_dane_porownanie_srednia_calosc($konfiguracja);
            break;
        }
    }

    public function pobierz_porownanie($get) {
        if (isset($get[AnalizaDanychCore::POROWNANIE_PLEC])) {
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_PLEC);
        } elseif (isset($get[AnalizaDanychCore::POROWNANIE_LOKALIZACJA])) {
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_LOKALIZACJA);
        } elseif (isset($get[AnalizaDanychCore::POROWNANIE_DYSLEKSJA])) {
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_DYSLEKSJA);
        } elseif (isset($get[AnalizaDanychCore::POROWNANIE_CALOSC])) {
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_CALOSC);
        } elseif (isset($get[AnalizaDanychCore::POROWNANIE_ZADANIA])) {
            $konfiguracja = array(
                    'rodzaj_danych' => !empty($get['rodzaj_danych'])? $get['rodzaj_danych'] : AnalizaDanychCore::POROWNANIE_CALOSC,
                    'klasa' => !empty($get['klasa'])? strtoupper($get['klasa']) : 'szkola',
            );
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_ZADANIA, $konfiguracja);
        } elseif (isset($get[AnalizaDanychCore::POROWNANIE_OBSZAR])) {
            $konfiguracja = array(
                    'rodzaj_danych' => !empty($get['rodzaj_danych'])? $get['rodzaj_danych'] : AnalizaDanychCore::POROWNANIE_CALOSC,
                    'klasa' => !empty($get['klasa'])? strtoupper($get['klasa']) : 'szkola',
                    'obszar' => !empty($get['obszar'])? strtoupper($get['obszar']) : 'I',
            );
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_OBSZAR, $konfiguracja);
        } else {
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_CALOSC);
        }
    }
    public function pobierz_dane_porownanie_srednia_calosc($konfig) {
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
        return $this->formatuj_do_datatable(self::POROWNANIE_CALOSC, $konfiguracja);
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
        return $this->formatuj_do_datatable(self::POROWNANIE_PLEC, $konfiguracja);
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
        return $this->formatuj_do_datatable(self::POROWNANIE_LOKALIZACJA, $konfiguracja);
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
        return $this->formatuj_do_datatable(self::POROWNANIE_DYSLEKSJA, $konfiguracja);
    }

    public function pobierz_dane_porownanie_srednia_obszar($konfig) {
        $konfiguracja = array(
                array (
                        'label' => 'Umiejętności dla obszaru '.$konfig['rodzaj_danych'],
                        'type' => 'string'
                ),
                array (
                        'label' => 'Średnia obszar '.$konfig['obszar'].' dla klasy '.$konfig['klasa'],
                        'type' => 'number'
                )
        );
        if ($konfig['rodzaj_danych'] != AnalizaDanych::POROWNANIE_CALOSC) {
            $konfiguracja = array(
                    array (
                            'label' => 'Umiejętności dla obszaru '.$konfig['rodzaj_danych'],
                            'type' => 'string'
                    ),
                    array (
                            'label' => 'Średnia ('.$konfig['rodzaj_danych'].') tak obszar '.$konfig['obszar'].' dla klasy '.$konfig['klasa'],
                            'type' => 'number'
                    ),
                    array (
                            'label' => 'Średnia '.$konfig['rodzaj_danych'].' nie obszar '.$konfig['obszar'].' dla klasy '.$konfig['klasa'],
                            'type' => 'number'
                    )
            );
        }
        return $this->formatuj_do_datatable_obszar($konfiguracja, $konfig);
    }

    public function pobierz_dane_porownanie_srednia_zadania($konfig) {
        $konfiguracja = array(
            array (
                'label' => 'Zadania',
                'type' => 'string'
            ),
            array (
                'label' => 'Średnia '.$konfig['klasa'],
                'type' => 'number'
            )
        );
        return $this->formatuj_do_datatable_zadania(self::POROWNANIE_ZADANIA, $konfiguracja, $konfig);
    }
}
?>
