

<?php
session_start();
require_once '../cnx1.php'; 
require_once '../Controller/ReclamationController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idReclamation = $_POST['idReclamation'] ?? null;
    $reponse = $_POST['reponse'] ?? '';

    if (empty($reponse)) {
        $_SESSION['error'] = "Le champ de réponse ne peut pas être vide.";
    } elseif (strlen($reponse) > 255) {
        $_SESSION['error'] = "La réponse ne peut pas dépasser 255 caractères.";
    } elseif (!preg_match('/^[a-zA-Z .,]*$/', $reponse)) {
        $_SESSION['error'] = "La réponse doit contenir uniquement des lettres, des points, des virgules et des espaces.";
    }

    if (!isset($_SESSION['error'])) {
        $db = Cnx1::getConnexion();
        $reclamationController = new ReclamationController($db);
        if ($reclamationController->addReponseAndUpdateStatus($idReclamation, $reponse)) {
            header("Location: listeReponse.php"); 
            exit;
        } else {
            $_SESSION['error'] = "Erreur lors de l'enregistrement de la réponse.";
        }
    }
    header("Location: repondreReclamation.php?id=" . $idReclamation); // Rediriger en renvoyant l'ID
    exit;
}

