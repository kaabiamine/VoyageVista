<?php
require_once '../Models/reclamation.php';
require_once '../Controllers/ReclamationController.php';
require_once '../cnx.php';

$reclamationController = new ReclamationController(Cnx::getConnexion());

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $idReclamation = $_GET['id'];
        $reclamationController->deleteReclamation($idReclamation);

        // Redirection vers la page de liste des réclamations après suppression
        header('Location: listeReclamation.php'); // Assurez-vous que le chemin est correct
        exit;
    } else {
        echo "Aucun ID de réclamation spécifié pour la suppression.";
        exit;
    }
}
?>
