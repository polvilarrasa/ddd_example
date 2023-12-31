<?php

namespace App\Application\Service\Customer;

use App\Application\Exception\Customer\CustomerEmailIsNotValidException;
use App\Application\Exception\Customer\CustomerPasswordIsNotValidException;
use App\Shared\Utils;

class CreateCustomerRequest
{
    private string $name;
    private string $email;
    private string $password;

    /**
     * @throws CustomerEmailIsNotValidException
     * @throws CustomerPasswordIsNotValidException
     */
    public function __construct(string $name, string $email, string $password)
    {
        if (!Utils::validateEmail($email)) {
            throw new CustomerEmailIsNotValidException($email);
        }
        if (!Utils::validatePassword($password)) {
            throw new CustomerPasswordIsNotValidException($password);
        }
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
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