<?php

include_once __DIR__ . '/../Connection.php';
include_once __DIR__ . '/../Model/ReservationModel.php';
class ReservationController {
    public function createReservation($reservation) {
        $pdo = Connection::getConnection();

        // Prepare SQL statement
        $sql = "INSERT INTO reservation (date_reservation, nom, prenom, email, telephone, nb_adultes,nb_enfants )
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind parameters
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$reservation->getDateReservation(), $reservation->getNom(), $reservation->getPrenom(),
            $reservation->getEmail(), $reservation->getTelephone(), $reservation->getNbEnfants(),
            $reservation->getNbAdultes()]);

        return $stmt->rowCount(); // Return number of affected rows
    }

    public function getReservationById($id) {
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
            $reservation['nb_adultes']);
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
                $reservation['nb_adultes']
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
        $nbEnfants = $reservationModel->getNbEnfants(); // Assuming integer number of children
        $nbAdultes = $reservationModel->getNbAdultes(); // Assuming integer number of adults

        // Build the UPDATE SQL statement dynamically
        $sql = "UPDATE reservation SET 
                   date_reservation = ?,
                   nom = ?,
                   prenom = ?,
                   email = ?,
                   telephone = ?,
                   nb_enfants = ?,
                   nb_adultes = ?
                   WHERE id = ?"; // Add WHERE clause for filtering

        try {
            $stmt = $pdo->prepare($sql);

            // Bind values to prepared statement with appropriate types
            $stmt->bindValue(1, $dateReservation, PDO::PARAM_STR); // String for date
            $stmt->bindValue(2, $nom, PDO::PARAM_STR); // String for name
            $stmt->bindValue(3, $prenom, PDO::PARAM_STR); // String for first name
            $stmt->bindValue(4, $email, PDO::PARAM_STR); // String for email
            $stmt->bindValue(5, $telephone, PDO::PARAM_STR); // String for phone number
            $stmt->bindValue(6, $nbEnfants, PDO::PARAM_INT); // Integer for number of children
            $stmt->bindValue(7, $nbAdultes, PDO::PARAM_INT); // Integer for number of adults
            $stmt->bindValue(8, $reservationId, PDO::PARAM_INT); // Integer for reservation ID

            // Execute the prepared statement for update
            $stmt->execute();

            return true; // Return true on successful execution (no exceptions)
        } catch (PDOException $e) {
            // Handle database errors (optional)
            // ...
            return false; // Return false on database errors
        }
    }



}
?>