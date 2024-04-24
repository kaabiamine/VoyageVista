<?php
require_once '../cnx.php' ;// Assurez-vous de mettre le chemin correct vers votre fichier cnx.php

try {
    $db = Cnx::getConnexion();
    if ($db) {
        echo "Connexion à la base de données réussie.";
    } else {
        echo "Connexion échouée.";
    }
} catch (Exception $e) {
    echo "Erreur lors de la connexion : " . $e->getMessage();
}
?>
