<?php

namespace App\Application\Presenter\Customer;

use App\Domain\Entity\Customer;

class CustomerToArrayPresenter
{
    public function write(Customer $customer): array
    {
        return [
            'id' => $customer->getId(),
            'name' => $customer->getName(),
            'email' => $customer->getEmail(),
            'password' => $customer->getPassword(),
            'created_at' => $customer->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}