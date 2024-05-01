<?php
class ReclamationController
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getReclamationsWithResponses() {
        $stmt = $this->db->prepare(
             "SELECT r.*, rp.reponse AS reponseTexte, rp.dateReponse, u.username
            FROM reclamation r
            LEFT JOIN reponse rp ON r.idReclamation = rp.idReclamation
            JOIN user u ON r.userId = u.id""
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addReponseAndUpdateStatus($idReclamation, $reponse) {
        try {
            $this->db->beginTransaction();
            // Insérer la réponse
            $stmt = $this->db->prepare("INSERT INTO reponse (idReclamation, texteReponse, dateReponse) VALUES (?, ?, NOW())");
            $stmt->execute([$idReclamation, $texte]);

            // Mettre à jour le statut de la réclamation à 'Traité'
            $stmt = $this->db->prepare("UPDATE reclamation SET status = 'Traité' WHERE idReclamation = ?");
            $stmt->execute([$idReclamation]);

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;  // ou gérer l'erreur comme souhaité
        }
    }
}
?>
