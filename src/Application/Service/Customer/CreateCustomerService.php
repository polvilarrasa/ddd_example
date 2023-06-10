<?php

namespace App\Application\Service\Customer;

use App\Application\Presenter\Customer\CustomerToArrayPresenter;
use App\Domain\Service\Customer\CreateCustomer;

class CreateCustomerService
{
    private CreateCustomer $createCustomer;

    public function __construct(CreateCustomer $createCustomer)
    {
        $this->createCustomer = $createCustomer;
    }

    public function execute(CreateCustomerRequest $request, CustomerToArrayPresenter $presenter): array
    {
        return $presenter->write(
            $this->createCustomer->execute(
                $request->getName(),
                $request->getEmail(),
                $request->getPassword()
            )
        );
    }
}