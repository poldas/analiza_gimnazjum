<?php
function debug($dane) {
	echo "<pre>";
    var_dump($dane);
    echo "</pre>";
}
class DBconnect {
	// połączenie z bazą danych
	const servername = "localhost";
	const username = "poldas69_analiza";
	const password = "powieki92";
	const dbname = "poldas69_wyniki2015";

	private static $dbhandler = null;
	private function __construct() {}
	private function __clone() {}

	public static function connect() {
		if(self::$dbhandler === null) {
			try {
			    self::$dbhandler = new PDO("mysql:host=".self::servername.";dbname=".self::dbname, self::username, self::password);
			    // set the PDO error mode to exception
			    self::$dbhandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//    echo "Connected successfully";
			}
			catch(PDOException $e) {
			    echo "Connection failed: " . $e->getMessage();
			}
		}
		return self::$dbhandler;
	}
}
?>
