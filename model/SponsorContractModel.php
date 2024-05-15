<?php
class  SponsorContractModel
{
    private ?int $id = null; // Nullable integer
    private DateTime $startDate; // DateTime object
    private DateTime $endDate; // DateTime object
    private string $paymentMethod; // String for payment method
    private bool $contractStatus; // Boolean for contract status
    private DateTime $createdAt; // DateTime for created date
    private DateTime $updatedAt; // DateTime for updated date
    private ?int $sponsorId = null; // Nullable integer
    private ?int $sponsorPackId = null; // Nullable integer

    /**
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param string $paymentMethod
     * @param bool $contractStatus
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param int|null $sponsorId
     * @param int|null $sponsorPackId
     */
    public function __construct(DateTime $startDate, DateTime $endDate, string $paymentMethod, bool $contractStatus, DateTime $createdAt, DateTime $updatedAt, ?int $sponsorId, ?int $sponsorPackId)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->paymentMethod = $paymentMethod;
        $this->contractStatus = $contractStatus;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->sponsorId = $sponsorId;
        $this->sponsorPackId = $sponsorPackId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function isContractStatus(): bool
    {
        return $this->contractStatus;
    }

    public function setContractStatus(bool $contractStatus): void
    {
        $this->contractStatus = $contractStatus;
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

    public function getSponsorId(): ?int
    {
        return $this->sponsorId;
    }

    public function setSponsorId(?int $sponsorId): void
    {
        $this->sponsorId = $sponsorId;
    }

    public function getSponsorPackId(): ?int
    {
        return $this->sponsorPackId;
    }

    public function setSponsorPackId(?int $sponsorPackId): void
    {
        $this->sponsorPackId = $sponsorPackId;
    }


}