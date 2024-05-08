<?php
require_once '../Models/reclamation.php';
require_once '../cnx.php';

class ReclamationController {
    private $db;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    // Fonction pour ajouter une réclamation à la base de données
    function addReclamation($reclamation) {
        $sql = "INSERT INTO reclamation (date, sujet, description, status, idUser) VALUES (:date, :sujet, :description, :status, :idUser)";
        try {
            $query = $this->db->prepare($sql);
            $query->bindValue(':date', $reclamation->getDate()->format('Y-m-d'));
            $query->bindValue(':sujet', $reclamation->getSujet());
            $query->bindValue(':description', $reclamation->getDescription());
            $query->bindValue(':status', $reclamation->getStatus());
            $query->bindValue(':idUser', $reclamation->getIdUser());
            $query->execute();
    
            // Si la réclamation est ajoutée avec succès, ajoutez une notification
            if ($query->rowCount() > 0) {
                $this->addNotification("Nouvelle réclamation", "Une nouvelle réclamation a été ajoutée  " . $reclamation->getIdUser());
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function addNotification($subject, $message) {
        $sql = "INSERT INTO notifications (subject, message) VALUES (:subject, :message)";
        $query = $this->db->prepare($sql);
        $query->bindValue(':subject', $subject);
        $query->bindValue(':message', $message);
        $query->execute();
    }
   

    public function getReclamations($idUser) {
        try {
            $sql = "SELECT * FROM reclamation WHERE idUser = :idUser";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de base de données : " . $e->getMessage());
        }
    }


public function getReclamationById($id) {
    $sql = "SELECT * FROM reclamation WHERE idReclamation = :id";
    try {
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur de base de données : " . $e->getMessage());
    }
}
public function updateReclamation($reclamation) {
    $sql = "UPDATE reclamation SET date = :date, sujet = :sujet, description = :description WHERE idReclamation = :id";
    try {
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $reclamation->getIdReclamation(), PDO::PARAM_INT);
        $stmt->bindValue(':date', $reclamation->getDate()->format('Y-m-d'));
        $stmt->bindValue(':sujet', $reclamation->getSujet());
        $stmt->bindValue(':description', $reclamation->getDescription());
      //  $stmt->bindValue(':status', $reclamation->getStatus());
        $stmt->execute();
    } catch (PDOException $e) {
        die("Erreur de mise à jour de la réclamation : " . $e->getMessage());
    }
}
public function deleteReclamation($idReclamation) {
    $sql = "DELETE FROM reclamation WHERE idReclamation = :idReclamation";
    try {
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idReclamation', $idReclamation, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Erreur lors de la suppression de la réclamation : " . $e->getMessage());
    }
}
}
?>
