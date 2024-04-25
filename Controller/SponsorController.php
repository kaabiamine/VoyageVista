<?php
include_once __DIR__ . '/../Connection.php';
include_once __DIR__ . '/../Model/SponsorModel.php';

class SponsorController {
    public function getAllSponsors() {
        try {
            $pdo = Connection::getConnection(); // Establish database connection

            // Prepare and execute the query
            $stmt = $pdo->query("SELECT * FROM sponsor");
            $sponsors = [];
            while ($row = $stmt->fetch()) {
                // Create SponsorModel instances for each row and add them to the array
                $sponsor = new SponsorModel(
                    $row['id'],
                    $row['sponsor_name'],
                    $row['sponsor_logo'],
                    $row['sponsor_description'],
                    $row['sponsor_email'],
                    $row['sponsor_phone'],
                    $row['sponsor_address'],
                    $row['sponsor_website']
                );
                $sponsors[] = $sponsor;
            }

            return $sponsors; // Return the array of SponsorModel instances
        } catch (PDOException $e) {
            // Handle database connection errors
            echo "Error: " . $e->getMessage();
            return []; // Return an empty array if an error occurs
        }
    }


    public function addSponsor(SponsorModel $sponsor): int {
        try {
            $pdo = Connection::getConnection(); // Establish database connection

            // Prepare the SQL statement
            $stmt = $pdo->prepare("INSERT INTO sponsor (sponsor_name, sponsor_logo, sponsor_description, sponsor_email, sponsor_phone, sponsor_address, sponsor_website) VALUES (?, ?, ?, ?, ?, ?, ?)");

            // Bind parameters and execute the query
            $stmt->execute([
                $sponsor->getSponsorName(),
                $sponsor->getSponsorLogo(),
                $sponsor->getSponsorDescription(),
                $sponsor->getSponsorEmail(),
                $sponsor->getSponsorPhone(),
                $sponsor->getSponsorAddress(),
                $sponsor->getSponsorWebsite(),
            ]);

            // After successfully inserting the sponsor, retrieve the last inserted ID
            $lastInsertId = (int) $pdo->lastInsertId();

            return (int)$lastInsertId; // Return the ID of the newly added sponsor
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Handle database connection errors
            return -1; // Return -1 if an error occurs
        }
    }

    public function getLastInsertId(): int {
        try {
            $pdo = Connection::getConnection(); // Establish database connection
            $lastId = $pdo->lastInsertId(); // Retrieve the last insert ID
            return (int)$lastId; // Return the last insert ID
        } catch (PDOException $e) {
            // Handle database connection errors
            echo "Error: " . $e->getMessage();
            return -1; // Return -1 if an error occurs
        }
    }

    public function updateSponsor(SponsorModel $sponsor) {
        try {
            $pdo = Connection::getConnection(); // Establish database connection

            // Prepare the SQL statement
            $stmt = $pdo->prepare("UPDATE sponsor SET sponsor_name = ?, sponsor_logo = ?, sponsor_description = ?, sponsor_email = ?, sponsor_phone = ?, sponsor_address = ?, sponsor_website = ? WHERE id = ?");

            // Bind parameters and execute the query
            $stmt->execute([$sponsor->getSponsorName(), $sponsor->getSponsorLogo(), $sponsor->getSponsorDescription(), $sponsor->getSponsorEmail(), $sponsor->getSponsorPhone(), $sponsor->getSponsorAddress(), $sponsor->getSponsorWebsite(), $sponsor->getId()]);

            return true; // Return true if the sponsor is updated successfully
        } catch (PDOException $e) {
            // Handle database connection errors
            echo "Error: " . $e->getMessage();
            return false; // Return false if an error occurs
        }
    }

    public function getSponsorById($sponsorId) {
        try {
            $pdo = Connection::getConnection(); // Establish database connection

            // Prepare the SQL statement
            $stmt = $pdo->prepare("SELECT * FROM sponsor WHERE id = ?");

            // Bind the parameter and execute the query
            $stmt->execute([$sponsorId]);

            // Fetch the result as an associative array
            $sponsorData = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if a sponsor was found
            if ($sponsorData) {
                // Create a new SponsorModel instance with the fetched data
                $sponsor = new SponsorModel(
                    $sponsorData['id'],
                    $sponsorData['sponsor_name'],
                    $sponsorData['sponsor_logo'],
                    $sponsorData['sponsor_description'],
                    $sponsorData['sponsor_email'],
                    $sponsorData['sponsor_phone'],
                    $sponsorData['sponsor_address'],
                    $sponsorData['sponsor_website']
                );

                // Set the ID of the sponsor
                //$sponsor->setId($sponsorData['id']);

                return $sponsor; // Return the SponsorModel object
            } else {
                return null; // Return null if no sponsor was found
            }
        } catch (PDOException $e) {
            // Handle database connection errors
            echo "Error: " . $e->getMessage();
            return null; // Return null if an error occurs
        }
    }

    public function deleteSponsorById($sponsorId) : bool{
        try {
            // Establish database connection
            $pdo = Connection::getConnection();

            // Prepare the SQL statement for deleting a sponsor
            $stmt = $pdo->prepare("DELETE FROM sponsor WHERE id = ?");

            // Bind the parameter and execute the query
            $stmt->execute([$sponsorId]);

            // Check if any rows were affected by the query
            if ($stmt->rowCount() > 0) {
                // If rows were affected, the deletion was successful
                return true; // Return true for success
            } else {
                return false; // Return false if no sponsor was found with the given ID
            }
        } catch (PDOException $e) {
            // Handle database connection errors
            echo "Error deleting sponsor: " . $e->getMessage();
            return false; // Return false if an error occurs
        }
    }

}
?>