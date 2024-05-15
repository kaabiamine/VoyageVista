<?php


class SponsorModel
{
    private int $id;
    private string $sponsor_name;
    private string $sponsor_logo;
    private string $sponsor_description;
    private string $sponsor_email;
    private string $sponsor_phone;
    private string $sponsor_address;
    private string $sponsor_website;

    /**
     * SponsorModel constructor.
     * @param int $id
     * @param string $sponsor_name
     * @param string $sponsor_logo
     * @param string $sponsor_description
     * @param string $sponsor_email
     * @param string $sponsor_phone
     * @param string $sponsor_address
     * @param string $sponsor_website
     */
    public function __construct(int $id, string $sponsor_name, string $sponsor_logo, string $sponsor_description, string $sponsor_email, string $sponsor_phone, string $sponsor_address, string $sponsor_website)
    {
        $this->id = $id;
        $this->sponsor_name = $sponsor_name;
        $this->sponsor_logo = $sponsor_logo;
        $this->sponsor_description = $sponsor_description;
        $this->sponsor_email = $sponsor_email;
        $this->sponsor_phone = $sponsor_phone;
        $this->sponsor_address = $sponsor_address;
        $this->sponsor_website = $sponsor_website;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSponsorName(): string
    {
        return $this->sponsor_name;
    }

    /**
     * @return string
     */
    public function getSponsorLogo(): string
    {
        return $this->sponsor_logo;
    }

    /**
     * @return string
     */
    public function getSponsorDescription(): string
    {
        return $this->sponsor_description;
    }

    /**
     * @return string
     */
    public function getSponsorEmail(): string
    {
        return $this->sponsor_email;
    }

    /**
     * @return string
     */
    public function getSponsorPhone(): string
    {
        return $this->sponsor_phone;
    }

    /**
     * @return string
     */
    public function getSponsorAddress(): string
    {
        return $this->sponsor_address;
    }

    /**
     * @return string
     */
    public function getSponsorWebsite(): string
    {
        return $this->sponsor_website;
    }
}


?>