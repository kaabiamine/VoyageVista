<?php
class Reponse
{
    private $idReponse;
    private $idReclamation;
    private $reponse;
    private $dateReponse;

    // Constructeur pour initialiser les propriétés de l'objet
    public function __construct($idReclamation, $reponse, $dateReponse, $idReponse = null) {
        $this->idReclamation = $idReclamation;
        $this->texte = $texte;
        $this->dateReponse = $dateReponse;
        $this->idReponse = $idReponse;  // Peut être null si la réponse n'est pas encore enregistrée dans la base de données
    }

    // Getters et Setters pour idReponse
    public function getIdReponse() {
        return $this->idReponse;
    }

    public function setIdReponse($idReponse) {
        $this->idReponse = $idReponse;
    }

    // Getters et Setters pour idReclamation
    public function getIdReclamation() {
        return $this->idReclamation;
    }

    public function setIdReclamation($idReclamation) {
        $this->idReclamation = $idReclamation;
    }

    // Getters et Setters pour texte
    public function getReounse() {
        return $this->reponse;
    }

    public function setTexte($reponse) {
        $this->reponse = $reponse;
    }

    // Getters et Setters pour dateReponse
    public function getDateReponse() {
        return $this->dateReponse;
    }

    public function setDateReponse($dateReponse) {
        $this->dateReponse = $dateReponse;
    }
}


?>