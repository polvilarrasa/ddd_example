<?php

namespace App\Domain\Service\Customer;

use App\Domain\Entity\Customer;
use App\Domain\Repository\CustomerInterface;

class EditCustomer
{
    private CustomerInterface $customerRepository;

    public function __construct(CustomerInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function execute($id, $name, $email, $password): Customer
    {
        $customer = $this->customerRepository->getCustomerById($id);

        $customer->edit($name, $email, $password);

        $this->customerRepository->save($customer);

        return $customer;
    }
}