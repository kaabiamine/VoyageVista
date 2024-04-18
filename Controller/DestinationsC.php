<?php

require_once 'C:\xampp\htdocs\VOYAGEVISTA\config.php'; // Include the config.php file

class DestinationsC
{
    public function listDestinations() 
    {
        $sql = "SELECT * FROM destination";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $res = $query->fetchAll();
            return $res;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getDestinationById($id)
    {
        $sql = "SELECT * FROM destination WHERE idD=:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            $result = $query->fetch();
            return $result;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

   public function addDestination($destination)
{
    $sql = "INSERT INTO destination (Nom_destinatio, Description) VALUES (:Nom_destinatio, :Description)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'Nom_destinatio' => $destination->getNom_destinatio(),
            'Description' => $destination->getDescription(),
        ]);
        $destination->setIdD($db->lastInsertId());
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}


public function modifyDestination($destination)
{
    $sql = "UPDATE destination SET Description=:Description, Nom_destinatio=:Nom_destinatio WHERE idD=:idD";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'idD' => $destination->getIdD(),
            'Description' => $destination->getDescription(),
            'Nom_destinatio' => $destination->getNom_destinatio(),
        ]);
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}




    public function deleteDestination($id)
    {
        $sql = "DELETE FROM destination WHERE idD=:idD";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['idD' => $id]);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

?>
