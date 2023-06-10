<?php

namespace App\Application\Service\Customer;

use App\Application\Presenter\Customer\CustomerToArrayPresenter;
use App\Domain\Exception\Customer\CustomerNotFoundException;
use App\Domain\Repository\CustomerInterface;

class GetCustomerByIdService
{
    private CustomerInterface $customerRepository;

    public function __construct(CustomerInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @throws CustomerNotFoundException
     */
    public function execute(GetCustomerByIdRequest $request, CustomerToArrayPresenter $presenter): array
    {
        $customer = $this->customerRepository->getCustomerById($request->getId());
        if (is_null($customer)) {
            throw new CustomerNotFoundException($request->getId());
        }

        return $presenter->write($customer);
    }
}