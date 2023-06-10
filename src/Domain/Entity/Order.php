<?php

namespace App\Domain\Entity;

class Order
{
    private string $id;
    private \DateTime $createdAt;
    private Customer $customer;

    private function __construct(string $id, \DateTime $createdAt, Customer $customer)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->customer = $customer;
    }

    public static function create(string $id, \DateTime $createdAt, Customer $customer): self
    {
        return new self($id, $createdAt, $customer);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

}
