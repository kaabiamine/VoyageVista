<?php

class Destination
{
    private $idD;
    private $nom_destinatio;
    private $description;
    private $rate;

    public function getIdD()
    {
        return $this->idD;
    }

    public function setIdD($idD)
    {
        $this->idD = $idD;
    }

    public function getNom_destinatio()
    {
        return $this->nom_destinatio;
    }

    public function setNom_destinatio($nom_destinatio)
    {
        $this->nom_destinatio = $nom_destinatio;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}


?>
