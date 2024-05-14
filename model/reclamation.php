<?php

class Reclamation
{
    private $idReclamation; 
    private $date;
    private $sujet;  
    private $description;
    private $status = "En cours";  // Statut par défaut
    private $idUser;

    // Constructeur avec paramètres
    public function __construct(DateTime $date, $sujet, $description, $idUser) {
        $this->date = $date;
        $this->sujet = $sujet;
        $this->description = $description;
        $this->idUser = $idUser;
    }


    // Getters et setters incluant getIdUser et setIdUser
    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    // Getters
    public function getIdReclamation()
    {
        return $this->idReclamation;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getSujet()
    {
        return $this->sujet;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getStatus()
    {
        return $this->status;
    }

    // Setters
    public function setIdReclamation($idReclamation) {
        $this->idReclamation = $idReclamation;
    }
    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }

    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}
?>
