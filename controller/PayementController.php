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

    public static function updatePayementById(int $payementId, PayementModel $payement): bool {
        $pdo = Connection::getConnection();

        $sql = "UPDATE payement 
            SET reservation_id = :reservation_id,
                mantant = :mantant,
                methode_de_payement = :methode_de_payement,
                rib = :rib,
                date_payement = :date_payement
            WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $reservationId = $payement->getReservationId();
        $mantant = $payement->getMantant();
        $methodeDePayement = $payement->getMethodeDePayement();
        $rib = $payement->getRib();
        $datePayement = $payement->getDatePayement()->format('Y-m-d H:i:s');

        // Bind values to the statement
        $stmt->bindParam(':reservation_id', $reservationId, PDO::PARAM_INT);
        $stmt->bindParam(':mantant', $mantant, PDO::PARAM_STR);
        $stmt->bindParam(':methode_de_payement', $methodeDePayement, PDO::PARAM_STR);
        $stmt->bindParam(':rib', $rib, PDO::PARAM_STR);
        $stmt->bindParam(':date_payement', $datePayement, PDO::PARAM_STR);
        $stmt->bindParam(':id', $payementId, PDO::PARAM_INT);

        try {
            $result = $stmt->execute();
            return $result; // Return true if the execution is successful
        } catch (PDOException $e) {
            error_log("Error updating payment: " . $e->getMessage());
            return false; // Return false if there's an error
        }
    }
    public static function getPayementById(int $payementId): ?PayementModel {
        // Get a database connection
        $pdo = Connection::getConnection();

        // Query to get payment by ID
        $sql = "SELECT * FROM payement WHERE id = :payement_id";

        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);

        // Bind the parameter
        $stmt->bindParam(':payement_id', $payementId, PDO::PARAM_INT);

        try {
            // Execute the query
            $stmt->execute();

            // Fetch the result as an associative array
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // If a record is found, create a PayementModel object
                $reservationId = $result['reservation_id'];
                $mantant = $result['mantant'];
                $methodeDePayement = $result['methode_de_payement'];
                $rib = $result['rib'];
                $datePayement = new DateTime($result['date_payement']);

                // Create and return a PayementModel object
                return new PayementModel($reservationId, $mantant, $methodeDePayement, $rib, $datePayement);
            } else {
                // If no record is found, return null
                return null;
            }
        } catch (PDOException $e) {
            // Log errors in case of database issues
            error_log("Error fetching payment by ID: " . $e->getMessage());
            return null;
        }
    }

    public function getPayementsByUserId(int $user_id): array {
        $pdo = Connection::getConnection();

        // SQL query to join the payement and reservation tables, filtered by user_id
        $sql = "
        SELECT p.id AS payement_id, 
               p.reservation_id,
               p.mantant, 
               p.methode_de_payement, 
               p.rib, 
               p.date_payement, 
               r.date_reservation,
               r.nom,
               r.prenom
        FROM payement AS p
        JOIN reservation AS r
        ON p.reservation_id = r.id
        WHERE r.user_id = :user_id
    ";

        // Prepare and execute the SQL statement
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch all results
        $payements = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Array to store PayementModel objects
        $payementModels = [];

        // Convert each row to a PayementModel object
        foreach ($payements as $payement) {
            $payementModel = new PayementModel(
                $payement['reservation_id'],
                $payement['mantant'],
                $payement['methode_de_payement'],
                $payement['rib'],
                new DateTime($payement['date_payement'])
            );
            $payementModel->setId($payement['payement_id']); // Set the ID
            $payementModels[] = $payementModel; // Add to the array
        }

        return $payementModels; // Returns an array of PayementModel objects
    }


    public function deletePayementById(int $idPayement): bool {
        // Get a connection to the database
        $pdo = Connection::getConnection();

        // Prepare the DELETE SQL statement
        $sql = "DELETE FROM payement WHERE id = :id"; // Use named parameter for safety

        try {
            // Prepare the statement
            $stmt = $pdo->prepare($sql);

            // Bind the parameter to the statement
            $stmt->bindValue(':id', $idPayement, PDO::PARAM_INT);

            // Execute the DELETE query
            $stmt->execute();

            // Check if any rows were affected (means the delete was successful)
            return $stmt->rowCount() > 0;

        } catch (PDOException $e) {
            // Handle the exception, you can log the error if needed
            return false; // Return false if there's an error
        }
    }


}