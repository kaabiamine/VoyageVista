<?php


require_once '../../model/reclamation.php';

require_once '../../cnx1.php';



class ReclamationController {
    private $db;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    public function getReclamationsAndResponsesByUserId($userId) {
        try {
            $stmt = $this->db->prepare(
                "SELECT r.idReclamation, r.sujet, r.description, rp.texteReponse, rp.dateReponse 
                FROM reclamation r 
                LEFT JOIN reponse rp ON r.idReclamation = rp.idReclamation 
                WHERE r.idUser = ?"
            );
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de base de données : " . $e->getMessage());
        }
    }
    

}
?>