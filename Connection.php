<?php
class Connection
{
    private static $pdo = null;

    public static function getConnection()
    {
        if (!isset($pdo)) {
            try {
                self::$pdo = new PDO("mysql:host=localhost;dbname=web1;", 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            } catch (PDOException $e) {
                die("Erreur " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>