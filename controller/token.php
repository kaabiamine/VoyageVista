<?php
// token_model.php

class TokenModel {
    private $db;

    public function __construct() {
        // Initialize the database connection
        $this->db = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Function to add a token to the database
    public function addToken($email, $token) {
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare("INSERT INTO password_reset_tokens (email, token) VALUES (:email, :token)");

            // Bind parameters and execute the statement
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            // Return true if the token was successfully added
            return true;
        } catch(PDOException $e) {
            // Handle any database errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
