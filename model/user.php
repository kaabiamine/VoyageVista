<?php

class User {
    private string $id;
    private string $email;
    private string $role;
    private string $name;
    private string $lastname;
    private string $password;
    private string $address;
    private int $age;
    private string $tel;

    public function __construct(string $id, string $email, string $role, string $name, string $lastname, string $password, string $address, int $age, string $tel) {
        $this->id = $id;
        $this->email = $email;
        $this->role = $role;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->password = $password;
        $this->address = $address;
        $this->age = $age;
        $this->tel = $tel;
    }

    public function getId(): string { return $this->id; }
    public function setId(string $id): void { $this->id = $id; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): void { $this->email = $email; }

    public function getRole(): string { return $this->role; }
    public function setRole(string $role): void { $this->role = $role; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }

    public function getLastname(): string { return $this->lastname; }
    public function setLastname(string $lastname): void { $this->lastname = $lastname; }

    public function getPassword(): string { return $this->password; }
    public function setPassword(string $password): void { $this->password = $password; }

    public function getAddress(): string { return $this->address; }
    public function setAddress(string $address): void { $this->address = $address; }

    public function getAge(): int { return $this->age; }
    public function setAge(int $age): void { $this->age = $age; }

    public function getTel(): string { return $this->tel; }
    public function setTel(string $tel): void { $this->tel = $tel; }
}

?>
