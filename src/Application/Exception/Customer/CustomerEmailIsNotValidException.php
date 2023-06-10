<?php

namespace App\Application\Exception\Customer;

class CustomerEmailIsNotValidException extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct("Customer email: $email is not a valid email.");
    }
}