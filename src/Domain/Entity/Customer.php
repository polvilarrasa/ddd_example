<?php

namespace App\Domain\Entity;

class Customer
{
    private string $id;
    private string $name;
    private string $email;
    private string $password;
    private \DateTime $createdAt;

    private function __construct(string $id, string $name, string $email, string $password, \DateTime $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
    }

    public static function create(string $id, string $name, string $email, string $password, \DateTime $createdAt): self
    {
        return new self($id, $name, $email, $password, $createdAt);
    }

    public function edit(string $name, string $email, string $password): void
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function __toString(): string
    {
        return $this->id;
    }

}