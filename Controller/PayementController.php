<?php

include_once __DIR__ . '/../Connection.php';
include_once __DIR__ . '/../Model/PayementModel.php';

class PayementController {
    static function addPayement(PayementModel $payement): bool {

        $pdo = Connection::getConnection();


        $sql = "INSERT INTO payement (reservation_id , mantant  , methode_de_payement, rib, date_payement) 
                VALUES (:reservation_id, :mantant, :methode_de_payement, :rib, :date_payement)";



        $stmt = $pdo->prepare($sql);

        $reservationId = $payement->getReservationId();
        $mantant = $payement->getMantant();
        $methodeDePayement = $payement->getMethodeDePayement();
        $rib = $payement->getRib();
        $datePayement = $payement->getDatePayement();
        $datePayementString = $datePayement->format('Y-m-d H:i:s');

        $stmt->bindParam(':reservation_id', $reservationId, PDO::PARAM_INT);
        $stmt->bindParam(':mantant', $mantant, PDO::PARAM_STR);
        $stmt->bindParam(':methode_de_payement', $methodeDePayement, PDO::PARAM_STR);
        $stmt->bindParam(':rib', $rib, PDO::PARAM_STR);
        $stmt->bindParam(':date_payement', $datePayementString , PDO::PARAM_STR); // Binding the date_payement



        try {
            $result = $stmt->execute();
            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error adding payment: " . $e->getMessage());
            return false;
        }
    }
}