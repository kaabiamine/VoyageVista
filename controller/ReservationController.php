<?php

include_once __DIR__ . '/../Connection.php';
include_once __DIR__ . '/../Model/ReservationModel.php';
class ReservationController {
    public function createReservation($reservation) {
        $pdo = Connection::getConnection();

        // Prepare SQL statement
        $sql = "INSERT INTO reservation (date_reservation, nom, prenom, email, telephone, nb_adultes,nb_enfants, status ,user_id )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind parameters
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$reservation->getDateReservation(), $reservation->getNom(), $reservation->getPrenom(),
            $reservation->getEmail(), $reservation->getTelephone(), $reservation->getNbEnfants(),
            $reservation->getNbAdultes(), $reservation->isStatus(), $reservation->getUserId()]);

        return $stmt->rowCount(); // Return number of affected rows
    }

    public static function getReservationById($id) {
        $pdo = Connection::getConnection();

        // Prepare SQL statement
        $sql = "SELECT * FROM reservation WHERE id = ?";

        // Prepare and execute statement
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        // Fetch result
        $reservation = $stmt->fetch();

        // Create and return ReservationModel object
        return new ReservationModel($reservation['date_reservation'], $reservation['nom'], $reservation['prenom'],
            $reservation['email'], $reservation['telephone'], $reservation['nb_enfants'],
            $reservation['nb_adultes'], $reservation['status'], $reservation['user_id']);
    }

    public function getReservationsByUserID($userID) {
        $pdo = Connection::getConnection();

        // SQL query to fetch reservations for a specific user ID
        $sql = "SELECT * FROM reservation WHERE user_id = :user_id";

        // Prepare and execute the statement with named parameter
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch all results as associative arrays
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Initialize an array to hold ReservationModel objects
        $reservationModels = [];

        // Loop through each fetched reservation and create ReservationModel instances
        foreach ($reservations as $reservation) {
            $reservationModel = new ReservationModel(
                $reservation['date_reservation'],
                $reservation['nom'],
                $reservation['prenom'],
                $reservation['email'],
                $reservation['telephone'],
                $reservation['nb_enfants'],
                $reservation['nb_adultes'],
                $reservation['status'],
                $reservation['user_id']
            );
            $reservationModel->setId($reservation['id']); // Set the reservation ID

            // Add to the list of ReservationModel objects
            $reservationModels[] = $reservationModel;
        }

        // Return the array of ReservationModel objects
        return $reservationModels;
    }

    public function deleteReservationById(int $id): bool {
        $pdo = Connection::getConnection();

        // Prepare the DELETE SQL statement
        $sql = "DELETE FROM reservation WHERE id = ?";

        try {
            $stmt = $pdo->prepare($sql);

            // Bind the ID parameter
            $stmt->bindValue(1, $id, PDO::PARAM_INT);

            // Execute the prepared statement
            $stmt->execute();

            // Check the number of affected rows (should be 1 for successful deletion)
            $deletedRows = $stmt->rowCount();
            return $deletedRows === 1; // Return true if exactly 1 row was affected
        } catch (PDOException $e) {
            // Handle database errors (optional)
            // ...
            return false; // Return false on database errors
        }
    }


    public function getAllReservations() {
        $pdo = Connection::getConnection();

        $sql = "SELECT * FROM reservation";

        $stmt = $pdo->query($sql);
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $reservationModels = [];
        foreach ($reservations as $reservation) {
            $reservationModel = new ReservationModel(
                $reservation['date_reservation'],
                $reservation['nom'],
                $reservation['prenom'],
                $reservation['email'],
                $reservation['telephone'],
                $reservation['nb_enfants'],
                $reservation['nb_adultes'] ,
                $reservation['status'],
                $reservation['user_id']
            );
            $reservationModel->setId($reservation['id']); // Set the ID
            $reservationModels[] = $reservationModel;
        }

        return $reservationModels;
    }

    public function updateReservationById(int $idReservation, ReservationModel $reservationModel): bool {
        $pdo = Connection::getConnection();

        // Extract data from ReservationModel object with type hints
        $reservationId = $idReservation; // Assuming integer ID
        $dateReservation = $reservationModel->getDateReservation(); // Assuming string date
        $nom = $reservationModel->getNom(); // Assuming string name
        $prenom = $reservationModel->getPrenom(); // Assuming string first name
        $email = $reservationModel->getEmail(); // Assuming string email
        $telephone = $reservationModel->getTelephone(); // Assuming string phone number
        $nbEnfants = $reservationModel->getNbEnfants();
        $nbAdultes = $reservationModel->getNbAdultes();
        $status = $reservationModel->isStatus();
        $user_id = $reservationModel->getUserId();
        // Build the UPDATE SQL statement dynamically
        $sql = "UPDATE reservation SET 
                   date_reservation = ?,
                   nom = ?,
                   prenom = ?,
                   email = ?,
                   telephone = ?,
                   nb_enfants = ?,
                   nb_adultes = ?,
                   user_id = ?
                   WHERE id = ?"; // Add WHERE clause for filtering

        try {
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(1, $dateReservation, PDO::PARAM_STR);
            $stmt->bindValue(2, $nom, PDO::PARAM_STR);
            $stmt->bindValue(3, $prenom, PDO::PARAM_STR);
            $stmt->bindValue(4, $email, PDO::PARAM_STR);
            $stmt->bindValue(5, $telephone, PDO::PARAM_STR);
            $stmt->bindValue(6, $nbEnfants, PDO::PARAM_INT);
            $stmt->bindValue(7, $nbAdultes, PDO::PARAM_INT);
            $stmt->bindValue(8, $user_id, PDO::PARAM_INT);
            $stmt->bindValue(9, $reservationId, PDO::PARAM_INT);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function Confirmer_payement(int $idReservation): bool {
        // Establish the database connection
        $pdo = Connection::getConnection();

        // SQL query to update the 'status' field to true where 'id' matches
        $sql = "UPDATE reservation SET status = true WHERE id = ?";

        try {
            // Prepare and execute the query
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $idReservation, PDO::PARAM_INT); // Bind the reservation ID
            $stmt->execute();

            return true; // Indicate successful update
        } catch (PDOException $e) {
            // If there's an error, return false to indicate failure
            return false;
        }
    }




}
?>