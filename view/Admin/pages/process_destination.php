<?php
require_once '../../../cnx1.php';
require_once '../../../model\Destination.php';
require_once '../../../controller\DestinationsC.php';

// Initialize DestinationC object
$destinationC = new DestinationsC(Cnx1::getConnexion());

// Add Destination
if (isset($_POST['add'])) {
    $description = $_POST['Description']; // Ensure the correct case for variable names
    $nom_destinatio = $_POST['Nom_destinatio']; // Ensure the correct case for variable names
    $rate = $_POST['rate']; // Ensure the correct case for variable names
    // Create a new Destination object
    $destination = new Destination();

    // Set the properties using the setter methods
    $destination->setDescription($description);
    $destination->setNom_destinatio($nom_destinatio);

    // Add the destination to the database
    $destinationC->addDestination($destination);

    // Redirect to the destination page after adding
    header('Location: Destination.php');
    exit();
}

// Update Destination
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $description = $_POST['Description']; // Ensure the correct case for variable names
    $nom_destinatio = $_POST['Nom_destinatio']; // Ensure the correct case for variable names
    $rate = $_POST['rate']; 
    // Create a new Destination object
    $destination = new Destination();

    // Set the properties using the setter methods
    $destination->setIdD($id);
    $destination->setDescription($description);
    $destination->setNom_destinatio($nom_destinatio);

    // Update the destination in the database
    $destinationC->modifyDestination($destination);

    // Redirect to the destination page after updating
    header('Location: Destination.php');
    exit();
}

// Delete Destination
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $destinationC->deleteDestination($id);

    // Redirect back to the destination page after deleting
    header('Location: Destination.php');
    exit();
}

// Handle other cases or errors
?>
