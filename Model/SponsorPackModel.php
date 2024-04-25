<?php

class SponsorPackModel
{
    private int $id;
    private string $packName;
    private string $packDescription;
    private float $packPrice;
    private bool $packStatus; // This might represent a boolean status (e.g., active/inactive)
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private string $imagePack;

    /**
     * @param string $packName
     * @param string $packDescription
     * @param float $packPrice
     * @param bool $packStatus
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param string $imagePack
     */
    public function __construct(string $packName, string $packDescription, float $packPrice, bool $packStatus, DateTime $createdAt, DateTime $updatedAt, string $imagePack)
    {
        $this->packName = $packName;
        $this->packDescription = $packDescription;
        $this->packPrice = $packPrice;
        $this->packStatus = $packStatus;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->imagePack = $imagePack;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPackName(): string
    {
        return $this->packName;
    }

    public function setPackName(string $packName): void
    {
        $this->packName = $packName;
    }

    public function getPackDescription(): string
    {
        return $this->packDescription;
    }

    public function setPackDescription(string $packDescription): void
    {
        $this->packDescription = $packDescription;
    }

    public function getPackPrice(): float
    {
        return $this->packPrice;
    }

    public function setPackPrice(float $packPrice): void
    {
        $this->packPrice = $packPrice;
    }


    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getImagePack(): string
    {
        return $this->imagePack;
    }

    public function setImagePack(string $imagePack): void
    {
        $this->imagePack = $imagePack;
    }

    public function isPackStatus(): bool
    {
        return $this->packStatus;
    }

    public function setPackStatus(bool $packStatus): void
    {
        $this->packStatus = $packStatus;
    }



}
