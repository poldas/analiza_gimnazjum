<?php
class AnalizaDanych {

	const SZKOLA = 'szkola';
	const ZAPYTANIE_WSZYSTKO = "select u.nr_ucznia,u.plec,u.dysleksja,we.klasa,we.kod_ucznia,we.nr_zadania,we.liczba_punktow,we.max_punktow,zu.nazwa_umiejetnosci,uk.umiejetnosc from wyniki_egzaminu as we left join zadanie_umiejetnosc as zu on we.nr_zadania=zu.numer_zadania left join umiejetnosc_kategoria as uk on uk.kategoria=zu.nazwa_umiejetnosci left join uczniowie as u on u.kod_ucznia=we.kod_ucznia order by we.kod_ucznia, u.nr_ucznia";
	const ZAPYTANIE_SREDNIA = "select sum(we.liczba_punktow) as suma_punktow, we.klasa
	        from wyniki_egzaminu as we
	        left join zadanie_umiejetnosc as zu on we.nr_zadania=zu.numer_zadania
	        left join umiejetnosc_kategoria as uk on uk.kategoria=zu.nazwa_umiejetnosci
	        left join uczniowie as u on u.kod_ucznia=we.kod_ucznia
	        group by we.klasa
	        order by we.klasa";
	private $dane = array();
	private $dbhandler = null;

	public function __construct() {
		$this->ustaw_db();
	}

	public function pobierz_dane() {
	    if (!$this->dane) {
	        $this->ustaw_dane();
	    }
	    return $this->dane;
	}

	public function ustaw_dane() {
	    $this->dane['all'] = $this->pobierz_dane_db(self::ZAPYTANIE_WSZYSTKO);
	}

	public function drukuj() {
	    print_r($this->pobierz_dane());
	}

	public function pobierz_srednia() {
	    $this->dane[self::SZKOLA] = $this->pobierz_srednia_szkola();
	    $this->dane[self::KLASA] = $this->pobierz_srednia_klasa();
	}

	private function pobierz_srednia_szkola() {
        return $this->pobierz_dane_db($sql)
	}

	private function pobierz_srednia_klasa() {

		return array();
	}

	private function zapytanie_srednia_suma_per_klasa() {
		$sql="select klasa,kod_ucznia,sum(liczba_punktow) as suma, avg(liczba_punktow) as srednia from wyniki_egzaminu group by klasa,kod_ucznia;";
	}
	private function ustaw_db() {
		$this->dbhandler = DBconnect::connect();
	}

	private function pobierz_dane_db($sql) {
	    $statement = $this->dbhandler->prepare($sql);
	    $statement->execute();
	    return $statement->fetchAll();
	}
}
?>