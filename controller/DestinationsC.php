<?php


class DestinationsC
{

    private $db;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }
    public function listDestinations() 
    {
        $sql = "SELECT * FROM destination";
        
        try {
            $query = $this->db->prepare($sql);
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
        
        try {
            $query = $this->db->prepare($sql);
            $query->execute(['id' => $id]);
            $result = $query->fetch();
            return $result;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

//    public function addDestination($destination)
// {
//     $sql = "INSERT INTO destination (Nom_destinatio, Description) VALUES (:Nom_destinatio, :Description)";
//     
//     try {
//         $query = $this->db->prepare($sql);
//         $query->execute([
//             'Nom_destinatio' => $destination->getNom_destinatio(),
//             'Description' => $destination->getDescription(),
//         ]);
//         $destination->setIdD($db->lastInsertId());
//     } catch (PDOException $e) {
//         die('Error: ' . $e->getMessage());
//     }
// }
public function addDestination($destination)
{
    $sql = "INSERT INTO destination (Nom_destinatio, Description, rate) VALUES (:Nom_destinatio, :Description, :rate)";
    
    try {
        $query = $this->db->prepare($sql);
        $query->execute([
            'Nom_destinatio' => $destination->getNom_destinatio(),
            'Description' => $destination->getDescription(),
            'rate' => 0, // Initialise le rate à 0
        ]);
        $destination->setIdD($this->db->lastInsertId());
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}


public function modifyDestination($destination)
{
    $sql = "UPDATE destination SET Description=:Description, Nom_destinatio=:Nom_destinatio WHERE idD=:idD";
    
    try {
        $query = $this->db->prepare($sql);
        $query->execute([
            'idD' => $destination->getIdD(),
            'Description' => $destination->getDescription(),
            'Nom_destinatio' => $destination->getNom_destinatio(),
        ]);
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}


public function addRate($destination_id, $rate)
{
    $sql = "UPDATE destination SET rate=:rate WHERE idD=:idD";
    
    try {
        $query = $this->db->prepare($sql);
        $query->execute([
            'idD' => $destination_id,
            'rate' => $rate,
        ]);
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

    public function deleteDestination($id)
    {
        $sql = "DELETE FROM destination WHERE idD=:idD";
        
        try {
            $query = $this->db->prepare($sql);
            $query->execute(['idD' => $id]);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

?>
