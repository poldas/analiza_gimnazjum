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
    protected function pobierz_dane_db($sql, $pdo_opt = null) {
        $statement = $this->dbhandler->prepare ( $sql );
        $statement->execute ();
        if(!$pdo_opt) {
            $pdo_opt = PDO::FETCH_ASSOC;
        }
        $dane_db = $statement->fetchAll ($pdo_opt);
        return $dane_db;
    }

    protected function dodaj_wpis_komentarza($id_wykresu, $opis) {
        $statement = $this->dbhandler->prepare(
            "INSERT INTO komentarz(id_wykresu, opis) VALUES(:id_wykresu, :opis)
                ON DUPLICATE KEY UPDATE id_wykresu= :id_wykresu, opis= :opis");
        $statement->execute(
            array(
                "id_wykresu" => $id_wykresu,
                "opis" => $opis,
        ));
    }

    /**
     * Zaokrągla wynik
     * @param number $liczba
     */
    protected function zaokraglij($liczba) {
    	$precyzja = 2;
    	return round($liczba, $precyzja);
    }
}
?>