<?php

namespace App\Application\Service\Order;

use App\Application\Exception\Customer\CustomerIdIsNotValidUuidException;
use App\Shared\Utils;

class GetOrdersFromCustomerRequest
{
    private string $customerId;

    /**
     * @throws CustomerIdIsNotValidUuidException
     */
    public function __construct(string $customerId)
    {
        $valid = Utils::validateUuid($customerId);
        if (!$valid) {
            throw new CustomerIdIsNotValidUuidException($customerId);
        }
        $this->customerId = $customerId;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

}
