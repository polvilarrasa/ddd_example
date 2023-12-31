<?php

namespace App\Application\Exception\Customer;

use Exception;

class CustomerIdIsNotValidUuidException extends Exception
{
    public function __construct(string $customerId)
    {
        parent::__construct("Customer id: $customerId is not a valid uuid.");
    }
}