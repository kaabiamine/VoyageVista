<?php
// Include necessary files and classes
require_once '../../../cnx1.php';
include_once '../../../controller\ForfaitC.php'; // Fixed path
require_once '../../../model\Forfait.php';

// Initialize ForfaitC object
$forfaitC = new ForfaitC(Cnx1::getConnexion());


// Add Forfait
if (isset($_POST['add_forfait'])) {
    // Retrieve form data
    $nomForfait = $_POST['Nom_forfait'];
    $prix = $_POST['Prix'];
    $dateDepart = $_POST['Date_depart'];
    $dateRetour = $_POST['Date_retour'];
    $placeDispo = $_POST['Place_dispo'];
    $idDestination = $_POST['Destination']; // Retrieve selected destination ID

    // Create a new Forfait object
    $forfait = new Forfait();

    // Set the properties using the setter methods
    $forfait->setNomForfait($nomForfait);
    $forfait->setPrix($prix);
    $forfait->setDateDepart($dateDepart);
    $forfait->setDateRetour($dateRetour);
    $forfait->setPlaceDispo($placeDispo);
    $forfait->setIdDestination($idDestination); // Set the destination ID

    // Add the forfait to the database
    $forfaitC->addForfait($forfait);

    // Redirect to the appropriate page after adding
    header('Location: Destination.php');
    exit();
}


// Check if the form is submitted to edit a forfait
if (isset($_POST['edit_forfait'])) {
    // Retrieve form data
    $id_forfait = $_POST['id_forfait'];
    $nomForfait = $_POST['nom_forfait'];
    $prix = $_POST['prix'];
    $date_depart = $_POST['date_depart'];
    $date_retour = $_POST['date_retour'];
    $place_disponible = $_POST['place_disponible'];

    // Create a new Forfait object
    $forfait = new Forfait();

    // Set the properties using the setter methods
    $forfait->setIdForfait($id_forfait);
    $forfait->setNomForfait($nomForfait);
    $forfait->setPrix($prix);
    $forfait->setDateDepart($date_depart);
    $forfait->setDateRetour($date_retour);
    $forfait->setPlaceDispo($place_disponible);

    // Update the forfait in the database
    $forfaitC->modifyForfait($forfait);

    // Redirect to the appropriate page after updating
    header('Location: Destination.php');
    exit();
}

// Delete Forfait
if (isset($_GET['delete'])) {
    // Retrieve the forfait ID from the URL parameter
    $id = $_GET['delete'];

    // Delete the forfait from the database
    $forfaitC->deleteForfait($id);

    // Redirect to the appropriate page after deleting
    header('Location: Destination.php');
    exit();
}

// Handle other cases or errors
?>
