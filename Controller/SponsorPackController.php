<?php
include_once __DIR__ . '/../Connection.php';
include_once __DIR__ . '/../Model/SponsorPackModel.php';
class SponsorPackController {
    public static function addPack(SponsorPackModel $sponsorPack): bool {
        // Get the database connection
        $pdo = Connection::getConnection();

        // Define the SQL statement to insert a new sponsor pack
        $sql = "INSERT INTO sponsor_pack (
                    pack_name,
                    pack_description,
                    pack_price,
                    pack_status,
                    create_at,
                    updated_at,
                    image_pack
                ) 
                VALUES (
                    :pack_name,
                    :pack_description,
                    :pack_price,
                    :pack_status,
                    :create_at,
                    :updated_at,
                    :image_pack
                )";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Get data from the SponsorPackModel object
        $packName = $sponsorPack->getPackName();
        $packDescription = $sponsorPack->getPackDescription();
        $packPrice = $sponsorPack->getPackPrice();
        $packStatus = $sponsorPack->isPackStatus();
        $createAt = $sponsorPack->getCreatedAt()->format('Y-m-d'); // Convert DateTime to string
        $updatedAt = $sponsorPack->getUpdatedAt()->format('Y-m-d'); // Convert DateTime to string
        $imagePack = $sponsorPack->getImagePack();

        // Bind the parameters to the statement
        $stmt->bindParam(':pack_name', $packName, PDO::PARAM_STR);
        $stmt->bindParam(':pack_description', $packDescription, PDO::PARAM_STR);
        $stmt->bindParam(':pack_price', $packPrice, PDO::PARAM_STR); // using PDO::PARAM_STR for float/double values
        $stmt->bindParam(':pack_status', $packStatus, PDO::PARAM_INT);
        $stmt->bindParam(':create_at', $createAt, PDO::PARAM_STR);
        $stmt->bindParam(':updated_at', $updatedAt, PDO::PARAM_STR);
        $stmt->bindParam(':image_pack', $imagePack, PDO::PARAM_STR);

        try {
            // Execute the statement and return true if successful
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle any exceptions/errors and log them
            error_log("Error adding sponsor pack: " . $e->getMessage());
            return false; // Return false if an error occurs
        }
    }

    public static function getAllSponsorPacks(): array {
        // Get the database connection
        $pdo = Connection::getConnection();

        // Define the SQL query to retrieve all sponsor packs
        $sql = "SELECT
                id , 
                pack_name	, 
                pack_description, 
                pack_price, 
                pack_status, 
                create_at, 
                updated_at, 
                image_pack
            FROM sponsor_pack"; // Adjust the table name to your schema

        try {
            // Prepare and execute the query
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Fetch all results as an associative array
            $sponsorPacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $sponsorPacks; // Return the fetched data
        } catch (PDOException $e) {
            // Handle exceptions and log errors
            error_log("Error retrieving sponsor packs: " . $e->getMessage());
            return []; // Return an empty array in case of error
        }
    }
    public static function deleteByPackID(int $packID): bool {
        // Get the database connection
        $pdo = Connection::getConnection();

        // Define the SQL query to delete a sponsor pack by ID
        $sql = "DELETE FROM sponsor_pack WHERE id = :id";

        try {
            // Prepare and execute the delete query
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $packID, PDO::PARAM_INT);

            return $stmt->execute(); // Returns true if the deletion is successful
        } catch (PDOException $e) {
            // Handle exceptions and log errors
            error_log("Error deleting sponsor pack: " . $e->getMessage());
            return false; // Return false in case of an error
        }
    }


    public static function updatePack(SponsorPackModel $sponsorPack, $idPack): bool {
        // Get the database connection
        $pdo = Connection::getConnection();

        // Define the SQL query to update the sponsor pack
        $sql = "UPDATE sponsor_pack 
            SET 
                pack_name = :pack_name,
                pack_description = :pack_description,
                pack_price = :pack_price,
                pack_status = :pack_status,
                updated_at = :updated_at,
                image_pack = :image_pack
            WHERE id = :id"; // 'id' is passed as parameter

        try {
            // Prepare the statement
            $stmt = $pdo->prepare($sql);

            // Assign values to variables for binding
            $packName = $sponsorPack->getPackName();
            $packDescription = $sponsorPack->getPackDescription();
            $packPrice = (float)$sponsorPack->getPackPrice(); // Convert to float
            $packStatus = (int)$sponsorPack->isPackStatus(); // Convert to int
            $updatedAt = $sponsorPack->getUpdatedAt()->format('Y-m-d'); // Convert to string
            $imagePack = $sponsorPack->getImagePack();

            // Bind the parameters using variables
            $stmt->bindParam(':pack_name', $packName, PDO::PARAM_STR);
            $stmt->bindParam(':pack_description', $packDescription, PDO::PARAM_STR);
            $stmt->bindParam(':pack_price', $packPrice, PDO::PARAM_STR); // Using PARAM_STR for float values
            $stmt->bindParam(':pack_status', $packStatus, PDO::PARAM_INT);
            $stmt->bindParam(':updated_at', $updatedAt, PDO::PARAM_STR);
            $stmt->bindParam(':image_pack', $imagePack, PDO::PARAM_STR);
            $stmt->bindParam(':id', $idPack, PDO::PARAM_INT); // New variable for 'id'

            // Execute the query
            return $stmt->execute(); // Returns true if successful
        } catch (PDOException $e) {
            // Handle exceptions and log errors
            error_log("Error updating sponsor pack: " . $e->getMessage());
            return false; // Return false if an error occurs
        }
    }

    public static function getPackByID(int $id): ?array {
        // Get the database connection
        $pdo = Connection::getConnection();

        // Define the SQL query to retrieve the sponsor pack with a specific ID
        $sql = "SELECT
            id, 
            pack_name, 
            pack_description, 
            pack_price, 
            pack_status, 
            create_at, 
            updated_at, 
            image_pack
        FROM sponsor_pack
        WHERE id = :id"; // Retrieve by ID

        try {
            // Prepare the query
            $stmt = $pdo->prepare($sql);

            // Bind the ID parameter to the query
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Execute the query
            $stmt->execute();

            // Fetch the result as an associative array
            $sponsorPack = $stmt->fetch(PDO::FETCH_ASSOC);

            // If a result was found, return it, otherwise return null
            return $sponsorPack ?: null; // Return null if not found
        } catch (PDOException $e) {
            // Handle exceptions and log errors
            error_log("Error retrieving sponsor pack by ID: " . $e->getMessage());
            return null; // Return null in case of error
        }
    }




}
