<?php
require_once '../Model/Reclamation.php';
require_once '../cnx1.php';

class ReclamationController {
    private $db;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }


   public function getReclamations() {
        try {
            $sql = "SELECT * FROM reclamation";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de base de données : " . $e->getMessage());
        }
    }


    public function getReclamationById($id) {
        $stmt = $this->db->prepare("SELECT * FROM reclamation WHERE idReclamation = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getReclamationsWithResponses() {
        $stmt = $this->db->prepare(
            "SELECT r.*, rp.texteReponse AS reponseTexte, rp.dateReponse 
            FROM reclamation r 
            LEFT JOIN reponse rp ON r.idReclamation = rp.idReclamation"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

 

    public function addReponseAndUpdateStatus($idReclamation, $reponse) {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("INSERT INTO reponse (idReclamation, texteReponse, dateReponse) VALUES (?, ?, NOW())");
            $stmt->execute([$idReclamation, $reponse]);
    
            $stmt = $this->db->prepare("UPDATE reclamation SET status = 'Traité' WHERE idReclamation = ?");
            $stmt->execute([$idReclamation]);
    
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log('Failed to add response and update status: ' . $e->getMessage());
           
            echo "Error: " . $e->getMessage();
            return false;
        }
        return true;
    }
    

}


?>
