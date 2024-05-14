<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $destination_id = $_POST['idD'];
    $rate = $_POST['rate'];

    // Inclure le fichier de la classe GestionDestinations
    require_once '../../cnx1.php';
    include_once '../..\controller\DestinationsC.php'; // Fixed path
    // Créer un nouvel objet GestionDestinations
    $gestionDestinations =  new DestinationsC(Cnx1::getConnexion());
    // Appeler la fonction addRate pour mettre à jour le rate de la destination dans la base de données
    $gestionDestinations->addRate($destination_id, $rate);
}
?>
