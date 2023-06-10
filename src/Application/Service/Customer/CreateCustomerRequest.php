<?php

namespace App\Application\Service\Customer;

use App\Application\Exception\Customer\CustomerIdIsNotValidUuidException;
use App\Shared\Utils;

class CreateCustomerRequest
{
    private string $customerId;
    private string $name;
    private string $email;
    private string $password;

    /**
     * @throws CustomerIdIsNotValidUuidException
     */
    public function __construct(string $customerId, string $name, string $email, string $password)
    {
        $valid = Utils::validateUuid($customerId);
        if (!$valid) {
            throw new CustomerIdIsNotValidUuidException($customerId);
        }
        $this->customerId = $customerId;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
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
}