<?php
include_once '../../Model/ReservationModel.php';
include_once "../../Controller/ReservationController.php";

// If submitted, access the reservation ID
$reservationId = $_GET['reservationId'];
$reservationController = new ReservationController();
$reservation = $reservationController->getReservationById($reservationId);
    if ($reservation) { // Check if a reservation was found
        $dateReservation = $reservation->getDateReservation();
        $nom = $reservation->getNom();
        $prenom = $reservation->getPrenom();
        $email = $reservation->getEmail();
        $telephone = $reservation->getTelephone();
        $nbEnfants = $reservation->getNbEnfants();
        $nbAdultes = $reservation->getNbAdultes();
    }
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If submitted using POST, update the reservation


    // Create a new ReservationModel object from the POST data
    $updatedReservation = new ReservationModel(
        $_POST['date_reservation'],
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $_POST['telephone'],
        (int)$_POST['nb_enfants'], // Cast to integer for safety
        (int)$_POST['nb_adultes']  // Cast to integer for safety
    );

    $reservationController = new ReservationController();
    $updateResult = $reservationController->updateReservationById($reservationId, $updatedReservation);

    // Handle successful update
    if ($updateResult) { // Assuming the method returns true on success
        // Redirect to AfficherReservation.php with a success message (optional)
        header("Location: AfficherReservations.php");
        exit; // Stop further script execution after redirect
    } else {
        // Handle failed update (e.g., display an error message)
        echo "Reservation update failed!";
    }
}

?>

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once('./components/head.php'); ?>

<body>
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php require_once('./components/navbar.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_settings-panel.html -->
        <?php require_once('./components/theme-setting-wrapper.php'); ?>
        <!-- partial -->
        <!-- partial:../../partials/_sidebar.html -->
        <?php require_once('./components/sidebar.php'); ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-8 grid-margin stretch-card d-flex justify-content-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Reservation</h4>
                                <p class="card-description">
                                    Update Reservation is done only by ADMIN
                                </p>
                                <form class="forms-sample"  method="post" onsubmit="return validateForm()" >
                                    <div class="form-group">
                                        <label for="date_reservation">Date Reservation</label>
                                        <input type="text" class="form-control" id="date_reservation" name="date_reservation" value="<?= $dateReservation; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nom">Nom</label>
                                        <input type="text" class="form-control" id="nom" name="nom" value="<?= $nom; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="prenom">Prénom</label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $prenom; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="telephone">Téléphone</label>
                                        <input type="text" class="form-control" id="telephone" name="telephone" value="<?= $telephone; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nb_enfants">Nombre d'Enfants</label>
                                        <input type="number" class="form-control" id="nb_enfants" name="nb_enfants" value="<?= $nbEnfants; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nb_adultes">Nombre d'Adultes</label>
                                        <input type="number" class="form-control" id="nb_adultes" name="nb_adultes" value="<?= $nbAdultes; ?>">
                                    </div>
                                    <div class="form-check form-check-flat form-check-primary">
                                        <div class="form-group">
                                            <label for="date_reservation">Date Reservation</label>
                                            <input type="datetime-local" class="form-control" id="date_reservation" name="date_reservation" value="<?= $dateReservation; ?>">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<?php require_once('./components/footer-scripts.php'); ?>
<script src="./input-validation/Reservation.js"></script>
</body>

</html>
