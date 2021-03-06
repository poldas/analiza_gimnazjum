<?php
function debug($dane) {
    var_dump($dane);
}
class DBconnect {
	// połączenie z bazą danych
	const servername = "localhost";
	const username = "poldas";
	const password = "zaqwsx";
	const dbname = "analizatestow";

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
