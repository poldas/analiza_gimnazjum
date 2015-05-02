<?php
class GeneratorBuilder {

	private $generator_automatyczny = null;
	private $dbhandler = null;

	public function __construct($zrodlo_danych) {
		$this->ustaw_generatory();
		$this->ustaw_dbhandler();
		$this->ustaw_zrodlo_danych($zrodlo_danych);
		return $this;
	}

	public function generuj_zapytanie_sql() {
		$this->generator_automatyczny->generuj_zapytanie_sql();
	}

	protected function ustaw_generatory() {
		$this->generator_automatyczny = new GeneratorWynikow();
		return $this;
	}

	protected function ustaw_dbhandler() {
		$this->dbhandler = DBconnect::connect();
		return $this;
	}

	protected function ustaw_zrodlo_danych($zrodlo_danych) {
		$this->generator_automatyczny->ustaw_zrodlo_danych($zrodlo_danych);
		return $this;
	}

	public function dodaj_wpis($wpis_sql) {
		try {
			$this->dbhandler->query($wpis_sql);
		} catch (Exception $e) {
			print_r($e->getMessage());
		}
	}
	public function pobierz_sql() {
		return $this->generator_automatyczny->pobierz_zapytanie_sql();
	}
	public function pobierz_dane() {
	    return $this->generator_automatyczny->pobierz_dane();
	}
	public function drukuj_sql() {
		print_r($this->pobierz_sql());
	}
	public function drukuj_dane() {
		print_r($this->generator_automatyczny->pobierz_dane());
	}
}