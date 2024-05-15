<?php
include_once '../../model/ReservationModel.php';
include_once "../../controller/ReservationController.php";

// USER VERIFICATION ===========================================================
include_once '../../controller/verify_login.php';

if (isset($_SESSION['user'])) {
    $user1 = $_SESSION['id'];
    $role = $_SESSION['role'];
    if ($role == 2) {
        header('Location: ../login.php');
    }
}else{
    header('Location: ../login.php');
}
//==============================================================================

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // If submitted using GET (not recommended for deleting data), display an error message
    echo "Reservations cannot be deleted using GET requests.";
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If submitted using POST
    $reservationId = (int)$_POST['reservationId']; // Cast to integer for safety

    $reservationController = new ReservationController();
    $deleteResult = $reservationController->deleteReservationById($reservationId);

    // Handle deletion result
    if ($deleteResult) {
        // Redirect to a success page (e.g., reservations list) with a success message
        header("Location: AfficherReservations.php");
        exit;
    } else {
        // Redirect to an error page or display an error message
        header("Location: AfficherReservations.php");
        exit;
    }
}



?>
