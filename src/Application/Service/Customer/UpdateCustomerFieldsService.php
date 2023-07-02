<?php

namespace App\Application\Service\Customer;

use App\Application\Presenter\Customer\CustomerToArrayPresenter;
use App\Domain\Exception\Customer\CustomerNotFoundException;
use App\Domain\Repository\CustomerInterface;
use App\Domain\Service\Customer\EditCustomer;

class UpdateCustomerFieldsService
{
    private CustomerInterface $customerRepository;
    private EditCustomer $editCustomer;

    public function __construct(CustomerInterface $customerRepository, EditCustomer $editCustomer)
    {
        $this->customerRepository = $customerRepository;
        $this->editCustomer = $editCustomer;
    }

    /**
     * @throws CustomerNotFoundException
     */
    public function execute(
        UpdateCustomerFieldsRequest $request,
        CustomerToArrayPresenter $presenter
    ): array
    {
        $customer = $this->customerRepository->getCustomerById($request->getCustomerId());
        if (is_null($customer)) {
            throw new CustomerNotFoundException($request->getCustomerId());
        }

        return $presenter->write(
            $this->editCustomer->execute(
                $customer->getId(),
                $request->getName(),
                $request->getEmail(),
                $customer->getPassword()
            )
        );
    }
}