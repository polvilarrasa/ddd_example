<?php

namespace App\Domain\Exception\Customer;

use Exception;

class CustomerNotFoundException extends Exception
{
    public function __construct(string $customerId)
    {
        parent::__construct("Customer with id: $customerId not found.");
    }
}