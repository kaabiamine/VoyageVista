<?php
class config
{
    private static $pdo = null;
    public static function getConnexion()
    {
        if (!isset(self::$pdo)) {
            $servername="localhost";
            $username="root";
            $password="";
            $dbname="web1";
            try {
                self::$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
                
            } catch (Exception $e) {
                die('Erreur: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
    public static function getCurrentUrl() {
        // Check for HTTPS or use HTTP as a fallback
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? "https" : "http";
        // Construct the base URL
        $url = $protocol . "://" . $_SERVER['HTTP_HOST'];
        // Append the requested resource URI
        $url .= $_SERVER['REQUEST_URI'];
    
        return $url;
    }
}

