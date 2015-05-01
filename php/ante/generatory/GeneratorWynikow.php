<?php
class GeneratorWynikow {

	private $nazwa_wyniki_egzaminu = 'wyniki_egzaminu';
	protected $dane = null;
	protected $zrodlo_danych = null;
	protected $zapytanie_sql = '';

	public function generuj_zapytanie_sql() {
		$this->ustaw_dane_ze_zrodla_danych();
		$this->generuj_tabela_wyniki_egzaminu();
	}
	public function ustaw_zrodlo_danych($dane) {
		$this->zrodlo_danych = $dane;
		return $this;
	}

	public function pobierz_dane() {
		return $this->dane;
	}
	public function pobierz_zapytanie_sql() {
		return $this->zapytanie_sql;
	}

	private function ustaw_dane_ze_zrodla_danych() {
		$dane_do_sparsowania = file($this->zrodlo_danych);
		$dane = $this->parsuj_dane($dane_do_sparsowania);
		$this->dane = $dane;
		return $this->dane;
	}
	private function parsuj_dane($dane_do_sparsowania) {
		// usuwamy nagłówek który jest numerami zadan
		$this->numery_zadan = array_shift($dane_do_sparsowania);
		return $dane_do_sparsowania;
	}
	private function generuj_tabela_wyniki_egzaminu($dane = null) {
		$dane_zapytania_sql = array();
		$dane = is_null($dane) ? $this->dane : $dane;
		foreach ($dane as $wiersz) {
			// z ciagu "A1,1,2,0,1,0..." tworzy tablicę i usuwa pierwszy element kod ucznia
			$tablica_wiersz = explode(',', $wiersz);
			$kod_ucznia = array_shift($tablica_wiersz);
			foreach ($tablica_wiersz as $i => $liczba_punktow) {
				// dane kol1, kol2, kol3 itd. do pojedynczego inserta w nawiasach (kol1, kol2, kol3, ...)
				// resetowane dla każdego wpisu
				$dane_do_inserta = array();

				// numer zadania liczony od 1, zadania są po kolei
				$nr_zadania = $i+1;

				// prosta walidacja
				$czy_puste_dane = empty($kod_ucznia) || empty($nr_zadania) || $liczba_punktow == '';
				if ($czy_puste_dane) {
					$err_dane = array('$klasa. $kod_ucznia,$wiersz, $i, $liczba_punktow',$kod_ucznia,$wiersz, $i, $liczba_punktow);
					print_r($err_dane);
					return;
				}

				// przygotowanie pojedynczego wpisu kolejność jest istotna
				$max_punktow = rand(0,2);
				$klasa = substr($kod_ucznia, 0, 1); // zostawia pierwszy znak, nazwe klasy np. 'A'
				array_push($dane_do_inserta, "'".$klasa."'");
				array_push($dane_do_inserta, "'".$kod_ucznia."'");
				array_push($dane_do_inserta, $nr_zadania);
				array_push($dane_do_inserta, $liczba_punktow);
				array_push($dane_do_inserta, $max_punktow);

				// dodanie wpisu w postaci gotowej do zapytania sql
				$dane_zapytania_sql[] = '('.join(',', $dane_do_inserta).')';
			}

		}
		// zapytanie końcowe sql
		$dane  = join(',', $dane_zapytania_sql);
		$sql = $dane ? "INSERT INTO ".$this->nazwa_wyniki_egzaminu." VALUES (".$dane.");" : '';
		$sql .="Update ".$this->nazwa_wyniki_egzaminu." set max_punktow = 1;";
		$sql .="Update ".$this->nazwa_wyniki_egzaminu." set max_punktow = 2 where numer_zadania in(21,25);";
		$sql .="Update ".$this->nazwa_wyniki_egzaminu." set max_punktow = 4 where numer_zadania in(22);";

		$this->zapytanie_sql = $sql;
		return $sql;
	}
}
?>