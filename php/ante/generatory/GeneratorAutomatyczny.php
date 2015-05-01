<?php
class GeneratorAutomatyczny {
	public $umiejetnosc = "
			('I','1.2'),
('I','1.7'),
('I','1.11'),
('I','3.2'),
('I','2.10'),
('I','3.3'),
('I','3.9'),
('II','2.2'),
('II','3.2'),
('II','3.1'),
('III','2.3'),
('III','2.1')
			";
	public $sql_zadania = "
INSERT INTO obszar_umiejetnosc VALUES (1,  '1.2');
INSERT INTO obszar_umiejetnosc VALUES (2,  'p');
INSERT INTO obszar_umiejetnosc VALUES (3,  '1.7');
INSERT INTO obszar_umiejetnosc VALUES (4,  '3.2');
INSERT INTO obszar_umiejetnosc VALUES (5,  '1.11');
INSERT INTO obszar_umiejetnosc VALUES (6,  '2.10');
INSERT INTO obszar_umiejetnosc VALUES (7,  '3.3');
INSERT INTO obszar_umiejetnosc VALUES (8,  '3.9');
INSERT INTO obszar_umiejetnosc VALUES (9,  'p');
INSERT INTO obszar_umiejetnosc VALUES (10,  '2.2');
INSERT INTO obszar_umiejetnosc VALUES (11,  '3.1');
INSERT INTO obszar_umiejetnosc VALUES (12,  '3.2');
INSERT INTO obszar_umiejetnosc VALUES (13,  '2.3');
INSERT INTO obszar_umiejetnosc VALUES (14,  '2.1');
INSERT INTO obszar_umiejetnosc VALUES (15,  '3t');
INSERT INTO obszar_umiejetnosc VALUES (16,  '3s');
INSERT INTO obszar_umiejetnosc VALUES (17,  '3st');
INSERT INTO obszar_umiejetnosc VALUES (18,  '3j');
INSERT INTO obszar_umiejetnosc VALUES (19,  '3o');
INSERT INTO obszar_umiejetnosc VALUES (20,  'p');
";
	const MIN_NUMER_ZADANIA = 1;
	const MAX_NUMER_ZADANIA = 1;

	const MIN_LICZBA_PUNKTOW = 0;
	const MAX_LICZBA_PUNKTOW = 2;

	const MIN_LITERA_KLASY = 'A';
	const MAX_LITERA_KLASY = 'F';

	const MIN_NUMER_UCZNIA = 1;
	const MAX_NUMER_UCZNIA = 32;

	/**
	 * Generuje numery zadan i max liczbe punktow
	 *
	 * @return multitype:multitype:number unknown
	 */
	function generuj_zadania() {
		$zadania = array ();
		foreach ( range ( MIN_NUMER_ZADANIA, MAX_NUMER_ZADANIA ) as $value ) {
			$zadania [] = array (
					'nr_zadania' => $value,
					'max_pkt' => rand(MIN_LICZBA_PUNKTOW, MAX_LICZBA_PUNKTOW)
			);
		}
		return $zadania;
	}

	/**
	 * Generuje dane uczniow
	 *
	 * @return multitype:multitype:string NULL unknown
	 */
	function generuj_uczniow() {
		$uczniowie = array ();
		foreach ( range ( MIN_LITERA_KLASY, MAX_LITERA_KLASY ) as $klasa ) {
			foreach ( range ( 1, 32 ) as $nr_ucznia ) {
				$uczniowie [] = array (
						'nr_ucznia' => $nr_ucznia,
						'kod_ucznia' => $klasa . $nr_ucznia,
						'klasa' => $klasa,
						'plec' => chr ( rand ( ord ( 'm' ), ord ( 'n' ) ) ),
						'dysleksja' => rand ( 0, 1 )
				);
			}
		}
		return $uczniowie;
	}
	function generuj_tabela_zadanie() {
		$danezsql = array ();
		foreach ( $this->generuj_zadania () as $zadanie ) {
			$danezsql [] = '("' . $zadanie ['nr_zadania'] . '","' . $zadanie ['max_pkt'] . '")';
		}
		$wyniki = join ( ',', $danezsql );
		return $wyniki;
	}
	function generuj_tabela_wynikiegzaminu() {
		$danezsql = array ();
		foreach ( $this->generuj_zadania () as $zadanie ) {
			foreach ( generuj_uczniow () as $uczen ) {
				$danezsql [] = '("' . $uczen ['kod_ucznia'] . '","' . $zadanie ['nr_zadania'] . '","' . rand ( 0, 2 ) . '")';
			}
			$wyniki = join ( ',', $danezsql );
		}
		return $wyniki;
	}
	function generuj_tabela_uczen() {
		$danezsql = array ();
		foreach ( $this->generuj_uczniow () as $uczen ) {
			$danezsql [] = '("' . $uczen ['nr_ucznia'] . '","' . $uczen ['kod_ucznia'] . '","' . $uczen ['klasa'] . '","' . $uczen ['plec'] . '","' . $uczen ['dysleksja'] . '")';
		}
		$wyniki = join ( ',', $danezsql );
		return $wyniki;
	}
	function generuj_tabela_zadanie_obszar() {
		$danezsql = array ();
		foreach ( $this->generuj_zadania () as $zadanie ) {
			$nr_zadania = ( int ) $zadanie ['nr_zadania'];
			$obszar = $nr_zadania < 9 ? 'I' : $nr_zadania < 13 ? "II" : "III";
			$danezsql [] = '("' . $nr_zadania . '","' . $obszar . '")';
		}
		$wyniki = join ( ',', $danezsql );
		return $wyniki;
	}
}