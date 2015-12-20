<?php
class GeneratorBuilder {

    /**
     * Logika generatora
     *
     * @var GeneratorWynikow
     */
    private $generator = null;
    private $dbhandler = null;

    /**
     * ustawia generator,
     * ustawia uchwyt bazy danych
     * ustawia źródło danych
     *
     * @param unknown $zrodlo_danych
     * @return GeneratorBuilder
     */
    public function __construct($zrodlo_danych = '') {
        $this->dbhandler = DBconnect::connect();
        $this->ustaw_generatory();

        if ($zrodlo_danych) {
            $this->ustaw_zrodlo_danych($zrodlo_danych);
        }

        return $this;
    }

    public function generuj_zapytanie_sql() {
        $this->generator->generuj_zapytanie_sql();
        echo $this->generator->pobierz_zapytanie_sql();
        echo $this->generator->pobierz_zapytanie_sql_obszar();
        echo $this->generator->pobierz_zapytanie_sql_obszary_zadanie();
        echo $this->generator->pobierz_zapytanie_sql_uczniowie();
    }

    public function generuj_zapytanie_sql_uczniowie() {
        $this->generator->generuj_zapytanie_sql_uczniowie();
    }
    public function generuj_zapytanie_sql_obszar() {
        $this->generator->generuj_zapytanie_sql_();
    }
    protected function ustaw_generatory() {
        $this->generator = new GeneratorWynikow();
        return $this;
    }

    public function ustaw_zrodlo_danych($zrodlo_danych) {
        $this->generator->ustaw_zrodlo_danych($zrodlo_danych);
        return $this;
    }

    public function ustaw_zrodlo_danych_uczniowie($zrodlo_danych) {
        $this->generator->ustaw_zrodlo_danych_uczniowie($zrodlo_danych);
    }

    public function dodaj_wpis($wpis_sql) {
        try {
            $this->dbhandler->query($wpis_sql);
        } catch (Exception $e) {
        	print_r($wpis_sql);
            print_r($e->getMessage());
        }
    }

    public function dodaj_dane_automatycznie() {
        $this->dodaj_wpis($this->pobierz_sql());
        $this->dodaj_wpis($this->pobierz_sql_obszar());
        $this->dodaj_wpis($this->pobierz_sql_uczniowie());
        $this->dodaj_wpis($this->pobierz_sql_obszary_zadanie());
    }
    public function pobierz_sql() {
        return $this->generator->pobierz_zapytanie_sql();
    }
    public function pobierz_sql_uczniowie() {
        return $this->generator->pobierz_zapytanie_sql_uczniowie();
    }
    public function pobierz_sql_obszar() {
        return $this->generator->pobierz_zapytanie_sql_obszar();
    }
    public function pobierz_sql_obszary_zadanie() {
    	return $this->generator->pobierz_zapytanie_sql_obszary_zadanie();
    }
    public function pobierz_dane() {
        return $this->generator->pobierz_dane();
    }
    public function drukuj_sql() {
        print_r($this->pobierz_sql_obszar());
    }
    public function drukuj_dane() {
        print_r($this->generator->pobierz_dane());
    }
}