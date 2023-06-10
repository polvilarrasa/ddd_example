<?php

namespace App\Application\Service\Customer;

use App\Application\Exception\Customer\CustomerIdIsNotValidUuidException;
use App\Shared\Utils;

class GetCustomerByIdRequest
{
    private string $id;

    /**
     * @throws CustomerIdIsNotValidUuidException
     */
    public function __construct(string $id)
    {
        if (!Utils::validateUuid($id)) {
            throw new CustomerIdIsNotValidUuidException($id);
        }

        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}