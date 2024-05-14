<?php


require_once '../../../cnx1.php';
require_once '../../../controller/ReclamationController.php';

$db = Cnx1::getConnexion();
$controller = new ReclamationController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $responseId = isset($_POST['responseId']) ? intval($_POST['responseId']) : 0;

    if ($responseId > 0) {
        if ($controller->deleteResponse($responseId)) {
            header("Location: listeReponse.php"); 
        } else {
            echo "Erreur lors de la suppression de la réponse.";
        }
    } else {
        echo "ID de réponse invalide.";
    }
} else {
    // N'autorisez pas l'accès direct à ce script sans POST
    echo "Accès non autorisé.";
}
?>
