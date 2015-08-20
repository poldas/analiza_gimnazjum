<?php
include 'generatory/Generator.php';
class GeneratorWynikow implements IGenerator {

    private $nazwa_wyniki_egzaminu = 'wyniki_egzaminu';
    private $nazwa_umiejetnosc_kategoria = 'obszary';
    private $nazwa_uczniowie = 'uczniowie';
    private $nazwa_obszary_zadanie = 'obszary_zadanie';
    
    protected $dane = array();
    protected $dane_uczniowie = array();
    protected $zrodlo_danych = '';
    protected $zrodlo_danych_uczniowie = '';
    protected $zapytanie_sql = '';
    protected $zapytanie_sql_obszar = '';
    protected $zapytanie_sql_uczniowie = '';
    protected $zapytanie_sql_obszar_zadanie = '';
    protected $nazwy_zadan = 0;
    protected $max_punkntow = array();
    protected $umiejetnosc = array();
    protected $obszar = array();

    public function generuj_zapytanie_sql() {
        $this->ustaw_dane_ze_zrodla_danych();
        $this->generuj_tabela_wyniki_egzaminu();
        $this->generuj_tabela_umiejetnosci_zadania();
        $this->generuj_tabela_obszary_zadania();
    }

    public function generuj_zapytanie_sql_uczniowie() {
        $this->ustaw_dane_ze_zrodla_danych_uczniowie();
        $this->generuj_tabela_uczniowie();
    }

    private function ustaw_dane_ze_zrodla_danych() {
        $dane_do_sparsowania = file($this->zrodlo_danych);
        if (!$dane_do_sparsowania) {
            echo "Brak danych do sparsowania.";
            return array();
        }
        $dane = $this->parsuj_dane($dane_do_sparsowania);
        $this->dane = $dane;
        return $this->dane;
    }

    private function ustaw_dane_ze_zrodla_danych_uczniowie() {
        $dane_do_sparsowania = file($this->zrodlo_danych_uczniowie);
        if (!$dane_do_sparsowania) {
            echo "Brak danych do sparsowania.";
            return array();
        }
        $this->dane_uczniowie = $dane_do_sparsowania;
        return $this->dane_uczniowie;
    }

    private function parsuj_dane($dane_do_sparsowania) {
        // usuwamy nagłówek który jest numerami zadan
        $this->nazwy_zadan = array_shift($dane_do_sparsowania);
        $this->nazwy_zadan = $this->usun_pierwszy_element($this->nazwy_zadan);
        $this->nazwy_zadan = explode(',', $this->nazwy_zadan);

        $this->obszar = array_shift($dane_do_sparsowania);
        $this->obszar = $this->usun_pierwszy_element($this->obszar);
        $this->obszar = explode(',', $this->obszar);

        $this->umiejetnosc = array_shift($dane_do_sparsowania);
        $this->umiejetnosc = $this->usun_pierwszy_element($this->umiejetnosc);
        $this->umiejetnosc = explode(',', $this->umiejetnosc);


        $this->max_punkntow = array_shift($dane_do_sparsowania);
        $this->max_punkntow = $this->usun_pierwszy_element($this->max_punkntow);
        $this->max_punkntow = explode(',', $this->max_punkntow);

        return $dane_do_sparsowania;
    }

    public function ustaw_zrodlo_danych($zrodlo_danych) {
        $this->zrodlo_danych = $zrodlo_danych;
        return $this;
    }

    public function ustaw_zrodlo_danych_uczniowie($zrodlo_danych) {
        $this->zrodlo_danych_uczniowie = $zrodlo_danych;
        return $this;
    }

    public function pobierz_dane() {
        if(!$this->dane){
            $this->ustaw_dane_ze_zrodla_danych();
        }
        return $this->dane;
    }

    public function pobierz_zapytanie_sql() {
        return $this->zapytanie_sql;
    }

    public function pobierz_zapytanie_sql_obszar() {
        return $this->zapytanie_sql_obszar;
    }
    public function pobierz_zapytanie_sql_obszary_zadanie() {
    	return $this->zapytanie_sql_obszar_zadanie;
    }
    public function pobierz_zapytanie_sql_uczniowie() {
        return $this->zapytanie_sql_uczniowie;
    }

    private function usun_pierwszy_element($wiersz){
        $tablica_wiersz = explode(',', $wiersz);
        array_shift($tablica_wiersz);
        array_pop($tablica_wiersz);
        array_pop($tablica_wiersz);
        array_pop($tablica_wiersz);
        return join(',', $tablica_wiersz);
    }

    private function generuj_tabela_wyniki_egzaminu($dane = null) {
        $dane_zapytania_sql = array();
        $dane_zapytania_sql_uczniowie = array();
        $dane = is_null($dane) ? $this->dane : $dane;

        foreach ($dane as $wiersz) {
            $tmp = array();
            // z ciagu "A1,1,2,0,1,0..." tworzy tablicę i usuwa pierwszy element kod ucznia
            $tablica_wiersz = explode(',', $wiersz);
            $kod_ucznia = array_shift($tablica_wiersz);
            $lokalizacja = array_pop($tablica_wiersz);
            $dysleksja = array_pop($tablica_wiersz);
            $plec = array_pop($tablica_wiersz);
            $nr_ucznia = preg_replace("/[^0-9]/", '', $kod_ucznia);
            $klasa = preg_replace("/[0-9]/", '', $kod_ucznia);
            /* wpisy do uczniów*/
            array_push($tmp, "'".trim($nr_ucznia)."'");
            array_push($tmp, "'".trim($kod_ucznia)."'");
            array_push($tmp, "'".trim($klasa)."'");
            array_push($tmp, "'".trim($plec)."'");
            array_push($tmp, "'".trim($dysleksja)."'");
            array_push($tmp, "'".trim($lokalizacja)."'");
            $dane_zapytania_sql_uczniowie[] = "(".join(',', $tmp).")";

            foreach ($tablica_wiersz as $i => $liczba_punktow) {
                // dane kol1, kol2, kol3 itd. do pojedynczego inserta w nawiasach (kol1, kol2, kol3, ...)
                // resetowane dla każdego wpisu
                $dane_do_inserta = array();

                // numer zadania liczony od 1, zadania są po kolei
                $nr_zadania = trim($this->nazwy_zadan[$i]);
                // prosta walidacja
                $czy_puste_dane = empty($kod_ucznia) || empty($nr_zadania) || $liczba_punktow == '';
                if ($czy_puste_dane) {
                    $err_dane = array('$klasa. $kod_ucznia,$wiersz, $i, $liczba_punktow',$kod_ucznia,$wiersz, $i, $liczba_punktow);
                    print_r($err_dane);
                    return;
                }

                /* wpisy do wyników*/
                // przygotowanie pojedynczego wpisu kolejność jest istotna
                $klasa = substr($kod_ucznia, 0, 1); // $wynik zostawia pierwszy znak, nazwe klasy np. 'A'
                array_push($dane_do_inserta, "'".$klasa."'");
                array_push($dane_do_inserta, "'".$kod_ucznia."'");
                array_push($dane_do_inserta, "'".$nr_zadania."'");
                array_push($dane_do_inserta, $liczba_punktow);
                array_push($dane_do_inserta, $this->max_punkntow[$i]);
                // dodanie wpisu w postaci gotowej do zapytania sql
                $dane_zapytania_sql[] = '('.join(',', $dane_do_inserta).')';
            }

        }
        // zapytanie końcowe sql
        $dane_wyniki = join(',', $dane_zapytania_sql);
        $sql = $dane_wyniki ? "INSERT INTO ".$this->nazwa_wyniki_egzaminu." VALUES ".$dane_wyniki.";" : '';
        $this->zapytanie_sql = $sql;

        // zapytanie końcowe sql
        $dane_uczniowie  = join(',', $dane_zapytania_sql_uczniowie);
        $sql = $dane_uczniowie ? "INSERT INTO ".$this->nazwa_uczniowie." VALUES ".$dane_uczniowie.";" : '';
        $this->zapytanie_sql_uczniowie = $sql;
        return $sql;
    }

    protected function generuj_tabela_umiejetnosci_zadania() {
        $liczba_elementow = count($this->umiejetnosc);
        $dane_do_inserta = array();
        for ($i = 0; $i < $liczba_elementow; $i++) {
            $umiejetnosc = trim($this->umiejetnosc[$i]);
            $obszar = trim($this->obszar[$i]);
            $zadanie = trim($this->nazwy_zadan[$i]);
            $this->generuj_umiejetnosc_obszar($umiejetnosc, $obszar, $zadanie, $dane_do_inserta);
        }

        $dane  = join(',', $dane_do_inserta);
        $sql = $dane ? "INSERT INTO ".$this->nazwa_umiejetnosc_kategoria." VALUES ".$dane.";" : '';
        $this->zapytanie_sql_obszar = $sql;
    }

    protected function generuj_tabela_obszary_zadania() {
    	$liczba_elementow = count($this->obszar);
    	$dane_do_inserta = array();
    	for ($i = 0; $i < $liczba_elementow; $i++) {
    		$tmp = array();
    		$obszar = trim($this->obszar[$i]);
    		$zadanie = trim($this->nazwy_zadan[$i]);
    		array_push($tmp, "'".$obszar."'");
            array_push($tmp, "'".$zadanie."'");
            array_push($dane_do_inserta, '('.join(',', $tmp).')');
    	}
    
    	$dane  = join(',', $dane_do_inserta);
    	$sql = $dane ? "INSERT INTO ".$this->nazwa_obszary_zadanie." VALUES ".$dane.";" : '';
    	$this->zapytanie_sql_obszar_zadanie = $sql;
    }
    
    /**
     * Generuje zapytanie do tablei obszar
     *
     * @param unknown $umiejetnosc_cala
     * @param unknown $obszar
     * @param unknown $zadanie
     * @param unknown $dane_do_inserta
     */
    protected function generuj_umiejetnosc_obszar($umiejetnosc_cala, $obszar, $zadanie, &$dane_do_inserta) {
        $umiejetnosci = explode('/', $umiejetnosc_cala);
        foreach ($umiejetnosci as $umiejetnosc) {
            $tmp = array();
            array_push($tmp, "'".$obszar."'");
            array_push($tmp, "'".$umiejetnosc."'");
            array_push($tmp, "'".$zadanie."'");
            array_push($dane_do_inserta, '('.join(',', $tmp).')');
        }
    }
}
?>