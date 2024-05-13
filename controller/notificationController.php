<?php

require_once '../../../cnx1.php';


class notificationController {
    private $db;
    
    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    //****************** recuperer les notifications*********************************** */
    function fetchNotifications() {
        $sql = "SELECT * FROM notifications WHERE is_read = FALSE ORDER BY created_at DESC";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


}