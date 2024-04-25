<?php
include_once '../../Model/ReservationModel.php';
include_once "../../Controller/ReservationController.php";

// Assuming you have a `ReservationController` class with the necessary methods

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
