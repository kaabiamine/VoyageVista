<?php

class ReservationModel {
  private int $id;
    private string $date_reservation;

    private string $nom;
    private string $prenom;
    private string $email;
    private string $telephone;
    private string $nb_enfants;
    private string $nb_adultes;
    private bool $status;

    private int $user_id;

    /**
     * @param string $date_reservation
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $telephone
     * @param string $nb_enfants
     * @param string $nb_adultes
     */
    public function __construct($date_reservation, $nom, $prenom, $email, $telephone, $nb_enfants, $nb_adultes ,$status , $user_id)
    {
        $this->date_reservation = $date_reservation;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->nb_enfants = $nb_enfants;
        $this->nb_adultes = $nb_adultes;
        $this->status = $status;
        $this->user_id = $user_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDateReservation()
    {
        return $this->date_reservation;
    }

    /**
     * @param string $date_reservation
     */
    public function setDateReservation($date_reservation)
    {
        $this->date_reservation = $date_reservation;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getNbEnfants()
    {
        return $this->nb_enfants;
    }

    /**
     * @param string $nb_enfants
     */
    public function setNbEnfants($nb_enfants)
    {
        $this->nb_enfants = $nb_enfants;
    }

    /**
     * @return string
     */
    public function getNbAdultes()
    {
        return $this->nb_adultes;
    }

    /**
     * @param string $nb_adultes
     */
    public function setNbAdultes($nb_adultes)
    {
        $this->nb_adultes = $nb_adultes;
    }


}
?>