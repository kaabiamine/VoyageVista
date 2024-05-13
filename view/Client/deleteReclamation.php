<?php
require_once '../../cnx1.php';
require_once '../../controller/ReclamationControllerFront.php';
require_once '../../model/reclamation.php';

$reclamationControllerFront = new ReclamationControllerFront(Cnx1::getConnexion());

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $idReclamation = $_GET['id'];
        $reclamationControllerFront->deleteReclamation($idReclamation);

        // Redirection vers la page de liste des réclamations après suppression
        header('Location: listeReclamation.php'); // Assurez-vous que le chemin est correct
        exit;
    } else {
        echo "Aucun ID de réclamation spécifié pour la suppression.";
        exit;
    }
}
?>
