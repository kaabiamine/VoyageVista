<?php

class Forfait
{
    private $id_forfait;
    private $id_destination;
    private $nom_forfait;
    private $prix;
    private $date_depart;
    private $date_retour;
    private $place_dispo;

    // Getters
    public function getIdForfait()
    {
        return $this->id_forfait;
    }

    public function getIdDestination()
    {
        return $this->id_destination;
    }

    public function getNomForfait()
    {
        return $this->nom_forfait;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function getDateDepart()
    {
        return $this->date_depart;
    }

    public function getDateRetour()
    {
        return $this->date_retour;
    }

    public function getPlaceDispo()
    {
        return $this->place_dispo;
    }

    // Setters
    public function setIdForfait($id_forfait)
    {
        $this->id_forfait = $id_forfait;
    }

    public function setIdDestination($id_destination)
    {
        $this->id_destination = $id_destination;
    }

    public function setNomForfait($nom_forfait)
    {
        $this->nom_forfait = $nom_forfait;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function setDateDepart($date_depart)
    {
        $this->date_depart = $date_depart;
    }

    public function setDateRetour($date_retour)
    {
        $this->date_retour = $date_retour;
    }

    public function setPlaceDispo($place_dispo)
    {
        $this->place_dispo = $place_dispo;
    }
}

?>
