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


    public function addSponsor(SponsorModel $sponsor):bool {
        try {
            $pdo = Connection::getConnection(); // Establish database connection

            // Prepare the SQL statement
            $stmt = $pdo->prepare("INSERT INTO sponsor (sponsor_name, sponsor_logo, sponsor_description, sponsor_email, sponsor_phone, sponsor_address, sponsor_website) VALUES (?, ?, ?, ?, ?, ?, ?)");

            // Bind parameters and execute the query
            $stmt->execute([$sponsor->getSponsorName(), $sponsor->getSponsorLogo(), $sponsor->getSponsorDescription(), $sponsor->getSponsorEmail(), $sponsor->getSponsorPhone(), $sponsor->getSponsorAddress(), $sponsor->getSponsorWebsite()]);

            return true; // Return true if the sponsor is added successfully
        } catch (PDOException $e) {
            // Handle database connection errors
            echo "Error: " . $e->getMessage();
            return false; // Return false if an error occurs
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
}
?>