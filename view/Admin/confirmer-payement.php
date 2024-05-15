<?php
include_once '../../Model/ReservationModel.php';
include_once "../../Controller/ReservationController.php";


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


$id = $_GET['reservationId'];

if ($id){
    $reservationController = new ReservationController();
    $resultat = $reservationController->Confirmer_payement($id);
    if ($resultat){
        header("Location: AfficherReservations.php");
        exit;
    }
    else{
        echo "Erreur lors de la confirmation du payement";
    }
}

?>
