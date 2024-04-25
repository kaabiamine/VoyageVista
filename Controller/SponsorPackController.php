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
}
