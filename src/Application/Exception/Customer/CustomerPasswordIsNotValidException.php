<?php

namespace App\Application\Exception\Customer;

use Exception;

class CustomerPasswordIsNotValidException extends Exception
{
    public function __construct(string $password)
    {
        parent::__construct("Customer password: $password is not a valid password.");
    }
}