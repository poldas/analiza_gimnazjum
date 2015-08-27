<?php
include 'AnalizaDanychCore.php';
class AnalizaDanych extends AnalizaDanychCore {
	const RODZAJ_DANYCH_SREDNIA = 'srednia';
	const RODZAJ_DANYCH_ZADANIA = 'zadania';
	const RODZAJ_DANYCH_OBSZAR = 'obszar';
	const RODZAJ_DANYCH_UMIEJETNOSC = 'umiejetnosc';

	const GRUPA_LOKALIZACJA = 'lokalizacja';
	const GRUPA_DYSLEKSJA = 'dysleksja';
	const GRUPA_PLEC = 'plec';

	public function porownanie($get) {
		$metadane_wykresu = $this->przygotuj_metadane_wykres ( $get );
		$dane_wykresow = array ();
		foreach ( $metadane_wykresu as $metadane_wykres ) {
			$dane_wykresow [] = array (
					'data' => $this->pobierz_dane_do_wykresu ( $metadane_wykres )
			);
		}
		echo $this->koduj_json ( $dane_wykresow );
	}

	protected function pobierz_wiersz_danych($metadane_wykres) {
		if ($metadane_wykres->rodzaj_danych == self::RODZAJ_DANYCH_SREDNIA) {
			if (empty ( $this->dane )) {
				$this->przygotuj_dane ();
			}
			$metadane_wykres->dane = $this->dane [$metadane_wykres->grupa];
			$metadane_wykres->klucz = array_keys ( $wiersz_danych );
		} elseif ($metadane_wykres->rodzaj_danych == self::RODZAJ_DANYCH_OBSZAR) {
			if (empty ( $this->dane_obszar )) {
				$this->przygotuj_dane_obszar ();
			}
			$metadane_wykres->dane = $this->dane_obszar [$metadane_wykres->grupa];
			$metadane_wykres->klucz = array_keys ( $wiersz_danych );
		} elseif ($metadane_wykres->rodzaj_danych == self::RODZAJ_DANYCH_ZADANIA) {
			if (empty ( $this->dane_zadanie )) {
				$this->przygotuj_dane_zadania();
			}
			$metadane_wykres->dane = $this->dane_zadanie [$metadane_wykres->grupa];
			$metadane_wykres->klucz = array_keys ( $wiersz_danych );
		} elseif ($metadane_wykres->rodzaj_danych == self::RODZAJ_DANYCH_UMIEJETNOSC) {
			if (empty ( $this->dane_umiejetnosc )) {
				$this->przygotuj_dane_obszar ();
			}
			$metadane_wykres->dane = $this->dane_obszar [$metadane_wykres->grupa];
			$metadane_wykres->klucz = array_keys ( $wiersz_danych );
		}
	}
	protected function pobierz_dane_do_wykresu($metadane_wykres) {
		$table = array ();
		$tmp_row = array ();
		$tmp_col = array ();
		$rows = array ();
		$tmp_col [] = array (
				'label' => 'Klasa',
				'type' => 'string'
		);
		$tmp_col [] = array (
				'label' => 'srednia',
				'type' => 'number'
		);
		$tmp_col [] = array (
				'role' => 'annotation',
				'type' => 'string'
		);
		$this->pobierz_wiersz_danych($metadane_wykres);

		foreach ( $metadane_wykres->klasa as $klasa ) {
			foreach ( $metadane_wykres->klucz as $klucz ) {
				$tmp_row = array ();
				$srednie = $wiersz_danych [$klucz] [$klasa] ['srednia_punktow'];
				$tmp_row [] = array (
						'v' => $metadane_wykres->grupa . ' ' . $klasa . ' ' . $klucz
				);
				$tmp_row [] = array (
						'v' => ( float ) $srednie
				);
				$tmp_row [] = array (
						'v' => ( float ) round ( $srednie, 2 )
				);
				$rows [] = array (
						'c' => $tmp_row
				);
			}
		}
		$table ['cols'] = $tmp_col;
		$table ['rows'] = $rows;
		return $table;
	}






	public function pobierz_porownanie($get) {
		if (isset ( $get [AnalizaDanychCore::POROWNANIE_PLEC] )) {
			echo $this->_pobierz_porownanie ( AnalizaDanychCore::POROWNANIE_PLEC );
		} elseif (isset ( $get [AnalizaDanychCore::POROWNANIE_LOKALIZACJA] )) {
			echo $this->_pobierz_porownanie ( AnalizaDanychCore::POROWNANIE_LOKALIZACJA );
		} elseif (isset ( $get [AnalizaDanychCore::POROWNANIE_SREDNIA] )) {
			echo $this->_pobierz_porownanie ( AnalizaDanychCore::POROWNANIE_SREDNIA );
		} elseif (isset ( $get [AnalizaDanychCore::POROWNANIE_DYSLEKSJA] )) {
			echo $this->_pobierz_porownanie ( AnalizaDanychCore::POROWNANIE_DYSLEKSJA );
		} elseif (isset ( $get [AnalizaDanychCore::POROWNANIE_CALOSC] )) {
			echo $this->_pobierz_porownanie ( AnalizaDanychCore::POROWNANIE_CALOSC );
		} elseif (isset ( $get [AnalizaDanychCore::POROWNANIE_ZADANIA] )) {
			$konfiguracja = array (
					'rodzaj_danych' => ! empty ( $get ['rodzaj_danych'] ) ? $get ['rodzaj_danych'] : AnalizaDanychCore::POROWNANIE_CALOSC,
					'klasa' => ! empty ( $get ['klasa'] ) ? strtoupper ( $get ['klasa'] ) : 'szkola'
			);
			echo $this->_pobierz_porownanie ( AnalizaDanychCore::POROWNANIE_ZADANIA, $konfiguracja );
		} elseif (isset ( $get [AnalizaDanychCore::POROWNANIE_OBSZAR] )) {
			$konfiguracja = array (
					'rodzaj_danych' => ! empty ( $get ['rodzaj_danych'] ) ? $get ['rodzaj_danych'] : AnalizaDanychCore::POROWNANIE_CALOSC,
					'klasa' => ! empty ( $get ['klasa'] ) ? strtoupper ( $get ['klasa'] ) : 'szkola',
					'obszar' => ! empty ( $get ['obszar'] ) ? strtoupper ( $get ['obszar'] ) : 'I'
			);
			echo $this->_pobierz_porownanie ( AnalizaDanychCore::POROWNANIE_OBSZAR, $konfiguracja );
		} else {
			echo $this->_pobierz_porownanie ( AnalizaDanychCore::POROWNANIE_CALOSC );
		}
	}
	public function pobierz_dane_porownanie_srednia() {
		return $this->pobierz_dane_porownanie_srednia_calosc ();
	}
	public function pobierz_dane_porownanie_srednia_calosc($konfig) {
		if (empty ( $this->dane )) {
			$this->przygotuj_dane ();
		}
		$konfiguracja = array (
				array (
						'label' => 'Klasa',
						'type' => 'string'
				),
				array (
						'label' => 'Średnia',
						'type' => 'number'
				)
		);
		return $this->formatuj_do_datatable ( self::POROWNANIE_CALOSC, $konfiguracja );
	}
	public function pobierz_dane_porownanie_srednia_plec() {
		if (empty ( $this->dane )) {
			$this->przygotuj_dane ();
		}
		$konfiguracja = array (
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
		return $this->formatuj_do_datatable ( self::POROWNANIE_PLEC, $konfiguracja );
	}
	public function pobierz_dane_porownanie_srednia_lokalizacja() {
		if (empty ( $this->dane )) {
			$this->przygotuj_dane ();
		}
		$konfiguracja = array (
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
		return $this->formatuj_do_datatable ( self::POROWNANIE_LOKALIZACJA, $konfiguracja );
	}
	public function pobierz_dane_porownanie_srednia_dysleksja() {
		if (empty ( $this->dane )) {
			$this->przygotuj_dane ();
		}
		$konfiguracja = array (
				array (
						'label' => 'Klasa',
						'type' => 'string'
				),
				array (
						'label' => 'Bez dysleksji',
						'type' => 'number'
				),
				array (
						'label' => 'Dysleksja',
						'type' => 'number'
				)
		);
		return $this->formatuj_do_datatable ( self::POROWNANIE_DYSLEKSJA, $konfiguracja );
	}
	public function pobierz_dane_porownanie_srednia_obszar($konfig) {
		if (empty ( $this->dane_obszar )) {
			$this->przygotuj_dane_obszar ();
		}
		$konfiguracja = array (
				array (
						'label' => 'Umiejętności dla ' . $konfig ['rodzaj_danych'],
						'type' => 'string'
				),
				array (
						'label' => 'Średnia obszar ' . $konfig ['obszar'] . ' dla ' . $konfig ['klasa'],
						'type' => 'number'
				)
		);
		if ($konfig ['rodzaj_danych'] != AnalizaDanych::POROWNANIE_CALOSC) {
			$wiersz_zadanie = $this->dane_obszar [$konfig ['obszar']] ['calosc'] [$konfig ['rodzaj_danych']];
			$klucze = array_keys ( $wiersz_zadanie );
			$konfiguracja = array (
					array (
							'label' => 'Umiejętności dla ' . $konfig ['rodzaj_danych'],
							'type' => 'string'
					),
					array (
							'label' => 'Średnia (' . $konfig ['rodzaj_danych'] . ') ' . $klucze [0] . ' obszar ' . $konfig ['obszar'] . ' dla klasy ' . $konfig ['klasa'],
							'type' => 'number'
					),
					array (
							'label' => 'Średnia (' . $konfig ['rodzaj_danych'] . ') ' . $klucze [1] . ' obszar ' . $konfig ['obszar'] . ' dla klasy ' . $konfig ['klasa'],
							'type' => 'number'
					)
			);
		}
		return $this->formatuj_do_datatable_obszar ( $konfiguracja, $konfig );
	}
	public function pobierz_dane_porownanie_srednia_zadania($konfig) {
		if (empty ( $this->dane_zadania )) {
			$this->przygotuj_dane_zadania ();
		}
		$konfiguracja = array (
				array (
						'label' => 'Zadania',
						'type' => 'string'
				),
				array (
						'label' => 'Średnia ' . $konfig ['klasa'],
						'type' => 'number'
				)
		);
		if ($konfig ['rodzaj_danych'] != AnalizaDanych::POROWNANIE_CALOSC) {
			$wiersz_zadanie = $this->dane_zadania [1] [$konfig ['rodzaj_danych']];
			$klucze = array_keys ( $wiersz_zadanie );
			$konfiguracja = array (
					array (
							'label' => 'Zadania ' . $konfig ['rodzaj_danych'],
							'type' => 'string'
					),
					array (
							'label' => 'Średnia (' . $konfig ['rodzaj_danych'] . ')' . $klucze [0] . ' dla  ' . $konfig ['klasa'],
							'type' => 'number'
					),
					array (
							'label' => 'Średnia (' . $konfig ['rodzaj_danych'] . ')' . $klucze [1] . ' dla ' . $konfig ['klasa'],
							'type' => 'number'
					)
			);
		}
		return $this->formatuj_do_datatable_zadania ( self::POROWNANIE_ZADANIA, $konfiguracja, $konfig );
	}

	protected function _pobierz_porownanie($porownanie, $konfiguracja = array()) {
		switch ($porownanie) {
			case self::POROWNANIE_PLEC :
				return $this->pobierz_dane_porownanie_srednia_plec ( $konfiguracja );
				break;
			case self::POROWNANIE_LOKALIZACJA :
				return $this->pobierz_dane_porownanie_srednia_lokalizacja ( $konfiguracja );
				break;
			case self::POROWNANIE_DYSLEKSJA :
				return $this->pobierz_dane_porownanie_srednia_dysleksja ( $konfiguracja );
				break;
			case self::POROWNANIE_ZADANIA :
				return $this->pobierz_dane_porownanie_srednia_zadania ( $konfiguracja );
				break;
			case self::POROWNANIE_OBSZAR :
				return $this->pobierz_dane_porownanie_srednia_obszar ( $konfiguracja );
				break;
			case self::POROWNANIE_SREDNIA :
				return $this->pobierz_dane_porownanie_srednia ( $konfiguracja );
				break;
			default :
				return $this->pobierz_dane_porownanie_srednia_calosc ( $konfiguracja );
				break;
		}
	}
}
?>
