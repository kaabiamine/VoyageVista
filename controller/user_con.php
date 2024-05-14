<?php

require 'connect.php';
class UserCon
{

    private $tab_name;

    public function __construct($tab_name = 'user')
    {
        $this->tab_name = $tab_name;
    }

    public function getUser($id)
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    public function listAdmins()
    {
        $sql = "SELECT * FROM $this->tab_name WHERE role = 1";
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function listClients()
    {
        $sql = "SELECT * FROM $this->tab_name WHERE role = 2";
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addUser($email, $role, $name, $lastname, $password, $address, $tel)
    {
        $db = config::getConnexion();

        $sql = "INSERT INTO $this->tab_name (email, role, nom, prenom, password, adresse, tel) VALUES (:email, :role, :nom, :prenom, :password, :addresse, :tel)";



        try {
            $query = $db->prepare($sql);
            $query->execute([
                'email' => $email,
                'role' => $role,
                'nom' => $name,
                'prenom' => $lastname,
                'password' => $password,
                'addresse' => $address,
                'tel' => $tel,
            ]);
            return true;
        } catch (Exception $e) {
            $sql1 = "INSERT INTO $this->tab_name (email, role, nom, prenom, Password, adresse, tel) VALUES ($email, $role, $name, $lastname, $password, $address, $tel)";
            echo 'Error: ' . $e->getMessage();
            return $e->getMessage();
        }
    }




    public function updateUser($id, $email, $role, $name, $lastname, $password, $address, $tel)
    {
        $db = config::getConnexion();


        $sql = "UPDATE $this->tab_name SET email = :email, role = :role, nom = :name, prenom = :lastname,tel = :tel, Password = :password, adresse = :address WHERE Id = :id";


        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'email' => $email,
                'role' => $role,
                'name' => $name,
                'lastname' => $lastname,
                'password' => $password,
                'address' => $address,
                'tel' => $tel
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    public function updateUserPassword($id, $newPassword)
    {
        $db = config::getConnexion();

        $sql = "UPDATE $this->tab_name SET password = :password WHERE id = :id"; // Corrected SQL statement

        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':id' => $id,
                ':password' => $newPassword
            ]);
            if ($query->rowCount() > 0) {
                echo "Password updated successfully.<br>";
                return true;
            } else {
                echo "No changes made to the password.<br>";
                return false;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM $this->tab_name WHERE Id = :id";
        $db = config::getConnexion();

        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM $this->tab_name WHERE email = :email";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':email', $email);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    public function addToken($email, $token)
{
    // Récupérer l'utilisateur par e-mail
    $user = $this->getUserByEmail($email);

    if ($user) {
        $userId = $user['id']; // Récupérer l'ID de l'utilisateur

        // Ajouter le token avec l'ID de l'utilisateur
        $db = config::getConnexion();
        $sql = "INSERT INTO password_reset_tokens (user_id, token) VALUES (:userId, :token)";

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'userId' => $userId,
                'token' => $token
            ]);
            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    } else {
        echo 'Error: User not found for email ' . $email;
        return false;
    }
}
    public function validateToken($token)
    {
        // Connect to the database
        $db = config::getConnexion();

        // Search for the token in the password_reset_tokens table
        $query = $db->prepare("SELECT * FROM password_reset_tokens WHERE token = :token ");
        $query->bindParam(':token', $token);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // If the token is found and has not expired, return true, otherwise return false
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function ResetUserPassword($token, $newPassword)
{
    // Connectez-vous à la base de données
    $db = config::getConnexion();

    // Recherchez l'utilisateur associé au jeton
    $userId = $this->getUserIdByToken($token);
    
    if ($userId) {
        // Mettez à jour le mot de passe de l'utilisateur
        $sql = "UPDATE $this->tab_name SET password = :password WHERE id = :userId";
        $updateQuery = $db->prepare($sql);
        $updateQuery->bindParam(':password', $newPassword); // Mettez le nouveau mot de passe sans le hacher à nouveau
        $updateQuery->bindParam(':userId', $userId);
        
        try {
            $updateQuery->execute();
            
            // Supprimez le jeton de la table des jetons une fois que le mot de passe est mis à jour
            $deleteQuery = $db->prepare("DELETE FROM password_reset_tokens WHERE token = :token");
            $deleteQuery->bindParam(':token', $token);
            $deleteQuery->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    } else {
        echo 'Error: User not found for token ' . $token;
        return false;
    }
}

    public function getUserIdByToken($token) {
        $db = config::getConnexion();
        $sql = "SELECT user_id FROM password_reset_tokens WHERE token = :token";
        try {
            $query = $db->prepare($sql);
            $query->execute([':token' => $token]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['user_id'];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    /*recherche*/

    function rechercheId($recherche) {
        $sql = "SELECT * FROM user WHERE ID = :recherche";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':recherche',$recherche );
            $query->execute();
            $result = $query->fetchAll();
            return $result;
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
}
