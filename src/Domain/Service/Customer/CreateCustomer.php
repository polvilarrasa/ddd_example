<?php

namespace App\Domain\Service\Customer;

use App\Domain\Entity\Customer;
use App\Domain\Repository\CustomerInterface;

class CreateCustomer
{
    private CustomerInterface $customerRepository;

    public function __construct(CustomerInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function execute($customerId, $name, $email, $password): Customer
    {
        $customer = Customer::create($customerId, $name, $email, $password, new \DateTime());

        $this->customerRepository->save($customer);

        return $customer;
    }
}