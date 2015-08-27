<?php
include 'AnalizaDanychSql.php';
abstract class AnalizaDanychCore implements AnalizaDanychSql {

    protected $dbhandler = null;
    protected $dane_db = array();
    protected $dane = array();
    protected $dane_zadania = array();
    protected $dane_obszar = array();
    protected $klasy = array();
    protected $obszary = array();
    protected $zadania = array();

    public function __construct() {
        $this->dbhandler = DBconnect::connect();
    }

    /**
     * Pobiera dane z zapytania sql
     * @param string $sql
     */
    protected function pobierz_dane_db($sql) {
        $statement = $this->dbhandler->prepare ( $sql );
        $statement->execute ();
        $dane_db = $statement->fetchAll ( PDO::FETCH_ASSOC );
        return $dane_db;
    }

    /**
     * Koduje dane do JSON
     * @param array $dane
     */
    protected function koduj_json($dane) {
        return json_encode($dane);
    }

    /**
     * Zaokrągla wynik
     * @param number $liczba
     */
    protected function zaokraglij($liczba) {
    	$precyzja = 2;
    	return round($liczba, $precyzja);
    }

    protected function przygotuj_metadane_wykres($metadane) {
    	if (! isset ( $metadane ['wykres'] )) {
    		throw new Exception ( "Brak danych wykresu" );
    	}
    	$wykresy = $metadane ['wykres'];
    	$dane_wykresu = array ();
    	foreach ( $wykresy as $nr_wykresu => $wykres ) {
    		$dane_wykresu [$nr_wykresu] = new AnalizaDane($wykres);
    	}
    	return $dane_wykresu;
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

    protected function przygotuj_dane_obszar() {
    	$dane_db = $this->pobierz_dane_db ( self::UNION_ALL_SREDNIA_OBSZAR_UMIEJETNOSC );
    	foreach ($dane_db as $wiersz_danych) {
    		$this->mapuj_dane_obszar($wiersz_danych);
    	}
    }

    /**
     * TODO mapuje dane do odpowiedniej architektury tablicy
     */
    protected function mapuj_dane_zadania($wiersz_danych) {
        $klasa = strtoupper($wiersz_danych['klasa']);
        $srednia = $this->zaokraglij($wiersz_danych['srednia_punktow']);
        $nr_zadania = $wiersz_danych['nr_zadania'];
        // $klucz określa jaką watość ma dane porównanie np lokalizacja m,w, płeć, c,d, dyslekcja 0,1
        if (!is_null($wiersz_danych[self::POROWNANIE_DYSLEKSJA])) {
            $klucz = $wiersz_danych[self::POROWNANIE_DYSLEKSJA];
            $this->dane_zadania[$nr_zadania][self::POROWNANIE_DYSLEKSJA][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
            );
        } else if (!is_null($wiersz_danych[self::POROWNANIE_LOKALIZACJA])) {
            $klucz = $wiersz_danych[self::POROWNANIE_LOKALIZACJA];
            $this->dane_zadania[$nr_zadania][self::POROWNANIE_LOKALIZACJA][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
            );
        } else if (!is_null($wiersz_danych[self::POROWNANIE_PLEC])) {
            $klucz = $wiersz_danych[self::POROWNANIE_PLEC];
            $this->dane_zadania[$nr_zadania][self::POROWNANIE_PLEC][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
            );
        } else {
            $klucz = 0; // całość danych nie ma porównania, dlatego wszystko znajduje się w pod kluczem
            $this->dane_zadania[$nr_zadania][self::POROWNANIE_CALOSC][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
            );
        }
    }

    protected function mapuj_dane_obszar($wiersz_danych) {
        $klasa = strtoupper($wiersz_danych['klasa']);
        $srednia = $this->zaokraglij($wiersz_danych['srednia_punktow']);
        $obszar = $wiersz_danych['obszar'];
        $umiejetnosc = !is_null($wiersz_danych['umiejetnosc']) ? $wiersz_danych['umiejetnosc'] : 'calosc';

        // $klucz określa jaką watość ma dane porównanie np lokalizacja m,w, płeć, c,d, dyslekcja 0,1
        if (!is_null($wiersz_danych[self::POROWNANIE_DYSLEKSJA])) {
            $klucz = $wiersz_danych[self::POROWNANIE_DYSLEKSJA];
            $this->dane_obszar[$obszar][$umiejetnosc][self::POROWNANIE_DYSLEKSJA][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
            );
        } else if (!is_null($wiersz_danych[self::POROWNANIE_LOKALIZACJA])) {
            $klucz = $wiersz_danych[self::POROWNANIE_LOKALIZACJA];
            $this->dane_obszar[$obszar][$umiejetnosc][self::POROWNANIE_LOKALIZACJA][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
            );
        } else if (!is_null($wiersz_danych[self::POROWNANIE_PLEC])) {
            $klucz = $wiersz_danych[self::POROWNANIE_PLEC];
            $this->dane_obszar[$obszar][$umiejetnosc][self::POROWNANIE_PLEC][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
            );
        } else {
            $klucz = 0; // całość danych nie ma porównania, dlatego wszystko znajduje się w pod kluczem
            $this->dane_obszar[$obszar][$umiejetnosc][self::POROWNANIE_CALOSC][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
            );
        }
    }

    /**
     * TODO mapuje dane do odpowiedniej architektury tablicy
     */
    protected function mapuj_dane($wiersz_danych) {
        $klasa = strtoupper($wiersz_danych['klasa']);
        $this->klasy[] = $klasa;
        $srednia = $this->zaokraglij($wiersz_danych['srednia_punktow']);
        if (!is_null($wiersz_danych[self::POROWNANIE_DYSLEKSJA])) {
            $klucz = $wiersz_danych[self::POROWNANIE_DYSLEKSJA];
            $this->dane[self::POROWNANIE_DYSLEKSJA][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
            );
        } else if (!is_null($wiersz_danych[self::POROWNANIE_LOKALIZACJA])) {
            $klucz = $wiersz_danych[self::POROWNANIE_LOKALIZACJA];
            $this->dane[self::POROWNANIE_LOKALIZACJA][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
            );
        } else if (!is_null($wiersz_danych[self::POROWNANIE_PLEC])) {
            $klucz = $wiersz_danych[self::POROWNANIE_PLEC];
            $this->dane[self::POROWNANIE_PLEC][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
            );
        } else {
            $klucz = 0;
            $this->dane[self::POROWNANIE_CALOSC][$klucz][$klasa] = array(
                    'srednia_punktow' => $srednia,
            );
        }
    }

    protected function formatuj_do_datatable($rodzaj_danych, $konfiguracja) {
        $rows = array ();
        $table = array ();
        if (empty($this->dane)) {
        	$this->przygotuj_dane();
        }
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
        $this->obszary[] = $obszar;
        $umiejetnosci = array_keys($this->dane_obszar[$obszar]);
        arsort($umiejetnosci);
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

        if (empty($this->dane_zadania)) {
        	$this->przygotuj_dane_zadania();
        }
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

class AnalizaDane {
	public function __construct($dane) {
		$this->rodzaj_danych = $dane['rodzaj_danych'];
		$this->grupa = $dane['grupa'];
		$this->klasy = explode ( ',', $dane ['klasa'] );
	}
	public $dane = array();
	public $klucz = array();
	public $rodzaj_danych = '';
	public $grupa = '';
	public $klasy = array();
}
?>