<?php

namespace App\Application\Service\Customer;

use App\Application\Exception\Customer\CustomerEmailIsNotValidException;
use App\Application\Exception\Customer\CustomerIdIsNotValidUuidException;
use App\Shared\Utils;

class UpdateCustomerFieldsRequest
{
    private string $customerId;
    private string $name;
    private string $email;

    /**
     * @throws CustomerIdIsNotValidUuidException
     * @throws CustomerEmailIsNotValidException
     */
    public function __construct(string $customerId, string $name, string $email)
    {
        if (!Utils::validateUuid($customerId)) {
            throw new CustomerIdIsNotValidUuidException($customerId);
        }
        if (!Utils::validateEmail($email)) {
            throw new CustomerEmailIsNotValidException($email);
        }
        $this->customerId = $customerId;
        $this->name = $name;
        $this->email = $email;
    }

    public function getCustomerId(): int
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
}