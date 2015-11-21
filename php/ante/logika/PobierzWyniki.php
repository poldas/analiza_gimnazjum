<?php
include 'AnalizaDanychCore.php';
include 'Highchart.php';
class PobierzWyniki extends AnalizaDanychCore {

	protected $dane_zmapowane = array();

	protected $dane_typ = array();

	protected $dane_typ_obszar = array();

	protected $dane_zadania = array();

	protected $dane_czestosc_wynikow = array();

	protected $klasy = array();

	protected $obszary = array();

	protected $umiejetnosci = array();

	protected $czestosc_wynikow = array();

	protected $komentarze = array();

	protected $konfiguracja_typ_wykresu = array(
		self::POROWNANIE_CALOSC => array('calosc'),
		self::POROWNANIE_DYSLEKSJA => array("bez dysleksji", "dysleksja"),
		self::POROWNANIE_LOKALIZACJA => array("miasto", "wieś"),
		self::POROWNANIE_PLEC => array("chłopcy", "dziewczyny"),
	);

	public function dodaj_komentarz($dane) {
	    $id_wykresu = $_GET['id_wykresu'];
	    $opis = htmlspecialchars($_GET['opis']);
	    $this->dodaj_wpis_komentarza($id_wykresu, $opis);
	    return 1;
	}

	protected function pobierz_komentarze() {
	    $this->komentarze = $this->pobierz_dane_db ( self::KOMENTARZE, PDO::FETCH_KEY_PAIR );
	    foreach ($this->komentarze as $key => $value) {
	        $this->komentarze[$key] = htmlspecialchars_decode($value);
	    }
	}

	public function pobierz() {
	    $srednia = $this->pobierz_srednia_highchart();
	    $obszary = $this->pobierz_obszar_highchart();
	    $zadania = $this->pobierz_zadania_highchart();
	    $czestosc = $this->pobierz_czestosc_highchart();
	    $wynik = array_merge($srednia, $obszary, $czestosc, $zadania);
	    return json_encode($wynik);
	}

    public function pobierz_obszar_highchart() {
        $this->pobierz_komentarze();
        $dane_db = $this->pobierz_dane_db ( self::UNION_ALL_SREDNIA_OBSZAR_UMIEJETNOSC, PDO::FETCH_ASSOC);
        foreach ($dane_db as $wiersz_danych) {
            $this->mapuj_dane_obszar($wiersz_danych);
        }
        $dane_do_js = array();
        $highchart = new Highchart();
        $highchart->ustaw_obszary($this->obszary)
            ->ustaw_klasy($this->klasy)
            ->ustaw_dane($this->dane_typ_obszar)
            ->ustaw_komentarz($this->komentarze)
            ->ustaw_konfiguracje($this->konfiguracja_typ_wykresu);

        return $highchart->pobierz_obszar_highchart();
    }

    public function pobierz_srednia_highchart() {
        $this->pobierz_komentarze();
        $dane_db = $this->pobierz_dane_db ( self::UNION_ALL_SREDNIA, PDO::FETCH_ASSOC);
        foreach ($dane_db as $wiersz_danych) {
            $this->mapuj_srednia($wiersz_danych);
        }
        $dane_do_js = array();
        $highchart = new Highchart();
        $highchart->ustaw_klasy($this->klasy)
            ->ustaw_dane($this->dane_typ)
            ->ustaw_komentarz($this->komentarze)
            ->ustaw_konfiguracje($this->konfiguracja_typ_wykresu);
        return $highchart->pobierz_srednia_highchart();
    }

    public function pobierz_srednia_grupy_highchart() {
        $this->pobierz_komentarze();
        $dane_db = $this->pobierz_dane_db ( self::UNION_SREDNIA_PUNKTOW_GRUPY, PDO::FETCH_ASSOC);
        foreach ($dane_db as $wiersz_danych) {
            $this->mapuj_srednia_grupy($wiersz_danych);
        }
        $dane_do_js = array();
        $highchart = new Highchart();
        $highchart->ustaw_klasy($this->klasy)
        ->ustaw_dane($this->dane_typ)
        ->ustaw_komentarz($this->komentarze)
        ->ustaw_konfiguracje($this->konfiguracja_typ_wykresu);
        return $highchart->pobierz_srednia_highchart();
    }

    public function pobierz_zadania_highchart() {
        $this->pobierz_komentarze();
        $dane_db = $this->pobierz_dane_db ( self::UNION_ALL_SREDNIA_ZADANIA, PDO::FETCH_ASSOC);
        foreach ($dane_db as $wiersz_danych) {
            $this->mapuj_dane_zadania($wiersz_danych);
        }
        $dane_do_js = array();
        $highchart = new Highchart();
        $highchart->ustaw_zadania($this->zadania)
            ->ustaw_klasy($this->klasy)
            ->ustaw_dane($this->dane_zadania)
            ->ustaw_komentarz($this->komentarze)
            ->ustaw_konfiguracje($this->konfiguracja_typ_wykresu);

        return $highchart->pobierz_zadania_highchart();
    }

    public function pobierz_czestosc_highchart() {
        $this->pobierz_komentarze();
        $dane_db = $this->pobierz_dane_db ( self::UNION_CZESTOSC_WYNIKOW, PDO::FETCH_ASSOC);
        foreach ($dane_db as $wiersz_danych) {
            $this->mapuj_dane_czestosc($wiersz_danych);
        }
        $dane_do_js = array();
        $highchart = new Highchart();
        $highchart->ustaw_czestosc_wynikow($this->czestosc_wynikow)
            ->ustaw_dane($this->dane_czestosc_wynikow)
            ->ustaw_klasy($this->klasy)
            ->ustaw_komentarz($this->komentarze)
            ->ustaw_konfiguracje($this->konfiguracja_typ_wykresu);

        return $highchart->pobierz_czestosc_wynikow_highchart();
    }

    protected function mapuj_dane_czestosc($wiersz_danych) {
        $klasa = strtoupper($wiersz_danych['klasa']);
        $this->klasy[$klasa] = $klasa;
        $ilosc_wynikow = $wiersz_danych['ilosc_wynikow'];
        $suma = $wiersz_danych['suma'];
        $this->czestosc_wynikow[$suma] = $suma;

        if (!is_null($wiersz_danych[self::POROWNANIE_DYSLEKSJA])) {
            $dysleksja = $wiersz_danych[self::POROWNANIE_DYSLEKSJA] == 'N'? 'bez dysleksji' : 'dysleksja';
            $this->dane_czestosc_wynikow[self::POROWNANIE_DYSLEKSJA][$suma][$dysleksja][$klasa] = $ilosc_wynikow;
        } else if (!is_null($wiersz_danych[self::POROWNANIE_LOKALIZACJA])) {
            $lokalizacja = $wiersz_danych[self::POROWNANIE_LOKALIZACJA] == 'mi'? 'miasto' : 'wieś';
            $this->dane_czestosc_wynikow[self::POROWNANIE_LOKALIZACJA][$suma][$lokalizacja][$klasa] = $ilosc_wynikow;
        } else if (!is_null($wiersz_danych[self::POROWNANIE_PLEC])) {
            $plec = $wiersz_danych[self::POROWNANIE_PLEC] == 'M'? 'chłopcy' : 'dziewczyny';
            $this->dane_czestosc_wynikow[self::POROWNANIE_PLEC][$suma][$plec][$klasa] = $ilosc_wynikow;
        } else {
            $this->dane_czestosc_wynikow[self::POROWNANIE_CALOSC][$suma]['calosc'][$klasa] = $ilosc_wynikow;
        }
    }

    protected function mapuj_dane_zadania($wiersz_danych) {
        $klasa = strtoupper($wiersz_danych['klasa']);
        $this->klasy[$klasa] = $klasa;
        $srednia = $this->zaokraglij($wiersz_danych['srednia_punktow']);
        $nr_zadania = $wiersz_danych['nr_zadania'];
        $this->zadania[$nr_zadania] = $nr_zadania;

        if (!is_null($wiersz_danych[self::POROWNANIE_DYSLEKSJA])) {
            $dysleksja = $wiersz_danych[self::POROWNANIE_DYSLEKSJA] == 'N'? 'bez dysleksji' : 'dysleksja';
            $this->dane_zadania[self::POROWNANIE_DYSLEKSJA][$nr_zadania][$dysleksja][$klasa] = $srednia;
        } else if (!is_null($wiersz_danych[self::POROWNANIE_LOKALIZACJA])) {
            $lokalizacja = $wiersz_danych[self::POROWNANIE_LOKALIZACJA] == 'mi'? 'miasto' : 'wieś';
            $this->dane_zadania[self::POROWNANIE_LOKALIZACJA][$nr_zadania][$lokalizacja][$klasa] = $srednia;
        } else if (!is_null($wiersz_danych[self::POROWNANIE_PLEC])) {
            $plec = $wiersz_danych[self::POROWNANIE_PLEC] == 'M'? 'chłopcy' : 'dziewczyny';
            $this->dane_zadania[self::POROWNANIE_PLEC][$nr_zadania][$plec][$klasa] = $srednia;
        } else {
            $this->dane_zadania[self::POROWNANIE_CALOSC][$nr_zadania]['calosc'][$klasa] = $srednia;
        }
    }

    protected function mapuj_dane_obszar($wiersz_danych) {
        $klasa = strtoupper($wiersz_danych['klasa']);
        $this->klasy[$klasa] = $klasa;
        $srednia = $this->zaokraglij($wiersz_danych['srednia_punktow']);
        $obszar = $wiersz_danych['obszar'];
        $umiejetnosc = !is_null($wiersz_danych['umiejetnosc']) ? $wiersz_danych['umiejetnosc'] : 'calosc';
        $this->obszary[$obszar][$umiejetnosc] = $umiejetnosc;

        if (!is_null($wiersz_danych[self::POROWNANIE_DYSLEKSJA])) {
            $dysleksja = $wiersz_danych[self::POROWNANIE_DYSLEKSJA] == 'N'? 'bez dysleksji' : 'dysleksja';
            $this->dane_typ_obszar[self::POROWNANIE_DYSLEKSJA][$obszar][$umiejetnosc][$dysleksja][$klasa] = $srednia;
        } else if (!is_null($wiersz_danych[self::POROWNANIE_LOKALIZACJA])) {
            $lokalizacja = $wiersz_danych[self::POROWNANIE_LOKALIZACJA] == 'mi'? 'miasto' : 'wieś';
            $this->dane_typ_obszar[self::POROWNANIE_LOKALIZACJA][$obszar][$umiejetnosc][$lokalizacja][$klasa] = $srednia;
        } else if (!is_null($wiersz_danych[self::POROWNANIE_PLEC])) {
            $plec = $wiersz_danych[self::POROWNANIE_PLEC] == 'M'? 'chłopcy' : 'dziewczyny';
            $this->dane_typ_obszar[self::POROWNANIE_PLEC][$obszar][$umiejetnosc][$plec][$klasa] = $srednia;
        } else {
            $this->dane_typ_obszar[self::POROWNANIE_CALOSC][$obszar][$umiejetnosc]['calosc'][$klasa] = $srednia;
        }
    }

    protected function mapuj_srednia_grupy($wiersz_danych) {
        $klasa = strtoupper($wiersz_danych['klasa']);
        $this->klasy[$klasa] = $klasa;
        $srednia = $this->zaokraglij($wiersz_danych['srednia_punktow']);
        if (!is_null($wiersz_danych[self::POROWNANIE_DYSLEKSJA])) {
            $dysleksja = $wiersz_danych[self::POROWNANIE_DYSLEKSJA] == 'N'? 'bez dysleksji' : 'dysleksja';
            $this->dane_typ[self::POROWNANIE_DYSLEKSJA][$dysleksja][$klasa] = $srednia;
        } else if (!is_null($wiersz_danych[self::POROWNANIE_LOKALIZACJA])) {
            $lokalizacja = $wiersz_danych[self::POROWNANIE_LOKALIZACJA] == 'mi'? 'miasto' : 'wieś';
            $this->dane_typ[self::POROWNANIE_LOKALIZACJA][$lokalizacja][$klasa] = $srednia;
        } else if (!is_null($wiersz_danych[self::POROWNANIE_PLEC])) {
            $plec = $wiersz_danych[self::POROWNANIE_PLEC] == 'M'? 'chłopcy' : 'dziewczyny';
            $this->dane_typ[self::POROWNANIE_PLEC][$plec][$klasa] = $srednia;
        } else {
            $this->dane_typ[self::POROWNANIE_CALOSC]['calosc'][$klasa] = $srednia;
        }
    }

    protected function mapuj_srednia($wiersz_danych) {
    	$klasa = strtoupper($wiersz_danych['klasa']);
    	$this->klasy[$klasa] = $klasa;
    	$srednia = $this->zaokraglij($wiersz_danych['srednia_punktow']);
    	if (!is_null($wiersz_danych[self::POROWNANIE_DYSLEKSJA])) {
    		$dysleksja = $wiersz_danych[self::POROWNANIE_DYSLEKSJA] == 'N'? 'bez dysleksji' : 'dysleksja';
    		$this->dane_typ[self::POROWNANIE_DYSLEKSJA][$dysleksja][$klasa] = $srednia;
    	} else if (!is_null($wiersz_danych[self::POROWNANIE_LOKALIZACJA])) {
    		$lokalizacja = $wiersz_danych[self::POROWNANIE_LOKALIZACJA] == 'mi'? 'miasto' : 'wieś';
    		$this->dane_typ[self::POROWNANIE_LOKALIZACJA][$lokalizacja][$klasa] = $srednia;
    	} else if (!is_null($wiersz_danych[self::POROWNANIE_PLEC])) {
    		$plec = $wiersz_danych[self::POROWNANIE_PLEC] == 'M'? 'chłopcy' : 'dziewczyny';
    		$this->dane_typ[self::POROWNANIE_PLEC][$plec][$klasa] = $srednia;
    	} else {
    		$this->dane_typ[self::POROWNANIE_CALOSC]['calosc'][$klasa] = $srednia;
    	}
    }
}