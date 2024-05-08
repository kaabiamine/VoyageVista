<?php
session_start();
require_once '../cnx1.php'; 
require_once '../Controller/ReclamationController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idReclamation = $_POST['idReclamation'] ?? null;
    $reponse = $_POST['reponse'] ?? '';

    // Validate response input
    if (empty($reponse)) {
        $_SESSION['error'] = "Le champ de réponse ne peut pas être vide.";
        header("Location: repondreReclamation.php?id=" . $idReclamation);
        exit;
    }
    if (strlen($reponse) > 255) {
        $_SESSION['error'] = "La réponse ne peut pas dépasser 255 caractères.";
        header("Location: repondreReclamation.php?id=" . $idReclamation);
        exit;
    }
    if (!preg_match('/^[a-zA-Z .,]*$/', $reponse)) {
        $_SESSION['error'] = "La réponse doit contenir uniquement des lettres, des points, des virgules et des espaces.";
        header("Location: repondreReclamation.php?id=" . $idReclamation);
        exit;
    }

    // If input is valid, process the addition of the response
    $db = Cnx1::getConnexion();
    $reclamationController = new ReclamationController($db);
    if ($reclamationController->addReponseAndUpdateStatus($idReclamation, $reponse)) {
        // Redirect to response list if success
        header("Location: listeReponse.php"); 
        exit;
    } else {
        // Stay on the page and show error if the response fails to save
        $_SESSION['error'] = "Erreur lors de l'enregistrement de la réponse.";
        header("Location: repondreReclamation.php?id=" . $idReclamation);
        exit;
    }
}

// Redirection if not POST or if other conditions fail
header("Location: repondreReclamation.php");
exit;
?>
