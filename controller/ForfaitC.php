<?php


class ForfaitC
{
    // Method to list all forfaits
    private $db;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }
    public function listForfaits() 
    {
        
        $query = $this->db->prepare("SELECT Forfait.*, Destination.nom_destinatio AS destination_name 
                               FROM forfait 
                               LEFT JOIN Destination ON forfait.id_destination = Destination.idD");
        $query->execute();
        return $query->fetchAll();
    }
    

    // Method to get a forfait by its ID
    public function getForfaitById($id_forfait)
    {
        
        $query = $this->db->prepare("SELECT * FROM forfait WHERE id_forfait = :id_forfait");
        $query->bindValue(':id_forfait', $id_forfait);
        $query->execute();
        return $query->fetch();
    }
    

    // Method to add a new forfait
    public function addForfait($forfait)
    {
        
        $query = $this->db->prepare("INSERT INTO forfait (id_destination, nom_forfait, prix, date_depart, date_retour, place_dispo) VALUES (:id_destination, :nom_forfait, :prix, :date_depart, :date_retour, :place_dispo)");
        $query->bindValue(':id_destination', $forfait->getIdDestination());
        $query->bindValue(':nom_forfait', $forfait->getNomForfait());
        $query->bindValue(':prix', $forfait->getPrix());
        $query->bindValue(':date_depart', $forfait->getDateDepart());
        $query->bindValue(':date_retour', $forfait->getDateRetour());
        $query->bindValue(':place_dispo', $forfait->getPlaceDispo());
        return $query->execute();
    }

    // Method to modify an existing forfait
    public function modifyForfait($forfait)
    {
        
        $query = $this->db->prepare("UPDATE forfait SET nom_forfait = :nom_forfait, prix = :prix, date_depart = :date_depart, date_retour = :date_retour, place_dispo = :place_dispo WHERE id_forfait = :id_forfait");
        $query->bindValue(':id_forfait', $forfait->getIdForfait());
        $query->bindValue(':nom_forfait', $forfait->getNomForfait());
        $query->bindValue(':prix', $forfait->getPrix());
        $query->bindValue(':date_depart', $forfait->getDateDepart());
        $query->bindValue(':date_retour', $forfait->getDateRetour());
        $query->bindValue(':place_dispo', $forfait->getPlaceDispo());
        return $query->execute();
    }

    // Method to delete a forfait by its ID
    public function deleteForfait($id)
    {
        
        $query = $this->db->prepare("DELETE FROM forfait WHERE id_forfait = :id");
        $query->bindValue(':id', $id);
        return $query->execute();
    }


    // Method to count the number of forfaits by destination
public function countForfaitsByDestination()
{
    
    $query = $this->db->prepare("
    SELECT d.Nom_destinatio, COUNT(f.id_forfait) AS count_forfaits
    FROM forfait f
    LEFT JOIN destination d ON f.id_destination = d.idD
    GROUP BY f.id_destination
");



    $query->execute();
    return $query->fetchAll();
}


public function searchForfaitByNomForfait($nomForfait)
{
    
    $query = $this->db->prepare("SELECT Forfait.*, Destination.nom_destinatio AS destination_name 
                           FROM forfait 
                           LEFT JOIN Destination ON forfait.id_destination = Destination.idD 
                           WHERE nom_forfait LIKE :nomForfait");
    $query->bindValue(':nomForfait', '%' . $nomForfait . '%');
    $query->execute();
    return $query->fetchAll();
}


public function filterForfaitsByDestination($destinationName)
{
    
    $query = $this->db->prepare("SELECT f.*, d.Nom_destinatio AS destination_name 
                           FROM forfait f
                           LEFT JOIN Destination d ON f.id_destination = d.idD
                           WHERE d.Nom_destinatio LIKE :destinationName");
    $query->bindValue(':destinationName', '%' . $destinationName . '%');
    $query->execute();
    return $query->fetchAll();
}



}

?>
