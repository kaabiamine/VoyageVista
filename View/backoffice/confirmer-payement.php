<?php
include_once '../../Model/ReservationModel.php';
include_once "../../Controller/ReservationController.php";
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
