<?php

class Cnx1 {
    private static $instance = null;
    private const SERVERNAME = "localhost";
    private const USERNAME = "root";
    private const PASSWORD = "";
    private const DATABASE = "web1";

    private function __construct() {
      
    }

    public static function getConnexion() {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO("mysql:host=" . self::SERVERNAME . ";dbname=" . self::DATABASE, self::USERNAME, self::PASSWORD);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                error_log("Échec de la connexion : " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}

?>
