<?php
include_once '../../Model/ReservationModel.php';
include_once "../../Controller/ReservationController.php";
$reservationController = new ReservationController();
$reservation = new ReservationModel(
    '2024-04-17',
    'Doe',
    'John',
    'john.doe@example.com',
    '123456789',
    '2',
    '2'
);
//------------------------------Add reservation Test
//$reservationController->createReservation($reservation);

//-------------------------------Get all reservations Test
//$reservations = $reservationController->getAllReservations();
//foreach ($reservations as $reservation) {
//    echo $reservation->getDateReservation() . "<br>";
//    echo $reservation->getNom() . "<br>";
//    echo $reservation->getPrenom() . "<br>";
//    echo $reservation->getEmail() . "<br>";
//    echo $reservation->getTelephone() . "<br>";
//    echo $reservation->getNbEnfants() . "<br>";
//    echo $reservation->getNbAdultes() . "<br>";
//    echo "<br>";
//}
//-------------------------------Get reservation by ID Test
//$reservation = $reservationController->getReservationById(1);
//echo $reservation->getDateReservation();
//echo $reservation->getNom();
//echo $reservation->getPrenom();
//echo $reservation->getEmail();
//echo $reservation->getTelephone();
//echo $reservation->getNbEnfants();
//echo $reservation->getNbAdultes();

?>
