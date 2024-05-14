<?php
// Include necessary files and classes
require_once '../../../..\config.php'; // Assuming you have a config.php file for database connection
require_once '../../../..\Model\Forfait.php'; // Include the Forfait model file
require_once '../../../..\Controller\ForfaitC.php'; // Include the ForfaitC class file

// Initialize ForfaitC object
$forfaitC = new ForfaitC();

// Check if the id_forfait parameter is provided in the URL
if(isset($_GET['id_forfait'])) {
    $forfaitId = $_GET['id_forfait'];
    
    // Retrieve the forfait details from the database
    $forfait = $forfaitC->getForfaitById($forfaitId);
    
    // Check if the forfait exists
    if($forfait) {
        // Now you have the forfait details, you can display the edit form
        ?>

        <!-- HTML form for editing the forfait -->
        <form method="POST" action="process_forfait.php">
    <!-- Hidden input field to store the forfait ID -->
    <input type="hidden" name="id_forfait" value="<?php echo $forfait['id_forfait']; ?>">
    
    <!-- Input fields for forfait details -->
    <div>
        <label>Nom forfait:</label>
        <input type="text" class="form-control" name="nom_forfait" value="<?php echo $forfait['nom_forfait']; ?>">
    </div>
    <div>
        <label>Prix:</label>
        <input type="text" class="form-control" name="prix" value="<?php echo $forfait['prix']; ?>">
    </div>
    <div>
        <label>Date départ:</label>
        <input type="text" class="form-control" name="date_depart" value="<?php echo $forfait['date_depart']; ?>">
    </div>
    <div>
        <label>Date retour:</label>
        <input type="text" class="form-control" name="date_retour" value="<?php echo $forfait['date_retour']; ?>">
    </div>
    <div>
        <label>Place disponible:</label>
        <input type="text" class="form-control" name="place_disponible" value="<?php echo $forfait['place_dispo']; ?>">
    </div>
    
    <!-- Button to submit the form -->
    <button type="submit" name="edit_forfait">Save Changes</button>
</form>


        <?php
    } else {
        // Forfait not found, display error message or redirect to error page
        echo "Forfait not found.";
    }
} else {
    // No id_forfait parameter provided in the URL, display error message or redirect to error page
    echo "Forfait ID not provided.";
}
?>
