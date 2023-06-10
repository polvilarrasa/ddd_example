<?php

namespace App\Application\Service\Customer;

use App\Application\Exception\Customer\CustomerIdIsNotValidUuidException;
use App\Application\Exception\Customer\CustomerPasswordIsNotValidException;
use App\Shared\Utils;

class UpdateCustomerPasswordRequest
{
    private string $customerId;
    private string $newPassword;

    /**
     * @throws CustomerIdIsNotValidUuidException
     * @throws CustomerPasswordIsNotValidException
     */
    public function __construct(string $customerId, string $newPassword)
    {
        if (!Utils::validateUuid($customerId)) {
            throw new CustomerIdIsNotValidUuidException($customerId);
        }
        if (!Utils::validatePassword($newPassword)) {
            throw new CustomerPasswordIsNotValidException($newPassword);
        }
        $this->customerId = $customerId;
        $this->newPassword = $newPassword;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }
}