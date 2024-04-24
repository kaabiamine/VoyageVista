<?php


class PayementModel {

    private int $id;
    private int $reservationId;
    private float $mantant;
    private string $methodeDePayement;
    private string $rib;
    private DateTime  $datePayement;


    /**
     * @param int $reservationId
     * @param float $mantant
     * @param string $methodeDePayement
     * @param string $rib
     * @param DateTime $datePayement
     */
    public function __construct(int $reservationId, float $mantant, string $methodeDePayement, string $rib, DateTime $datePayement)
    {
        $this->reservationId = $reservationId;
        $this->mantant = $mantant;
        $this->methodeDePayement = $methodeDePayement;
        $this->rib = $rib;
        $this->datePayement = $datePayement;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getReservationId(): int
    {
        return $this->reservationId;
    }

    public function setReservationId(int $reservationId): void
    {
        $this->reservationId = $reservationId;
    }

    public function getMantant(): float
    {
        return $this->mantant;
    }

    public function setMantant(float $mantant): void
    {
        $this->mantant = $mantant;
    }

    public function getMethodeDePayement(): string
    {
        return $this->methodeDePayement;
    }

    public function setMethodeDePayement(string $methodeDePayement): void
    {
        $this->methodeDePayement = $methodeDePayement;
    }

    public function getRib(): string
    {
        return $this->rib;
    }

    public function setRib(string $rib): void
    {
        $this->rib = $rib;
    }

    public function getDatePayement(): DateTime
    {
        return $this->datePayement;
    }

    public function setDatePayement(DateTime $datePayement): void
    {
        $this->datePayement = $datePayement;
    }



}