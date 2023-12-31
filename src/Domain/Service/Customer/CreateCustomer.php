<?php

namespace App\Domain\Service\Customer;

use App\Domain\Entity\Customer;
use App\Domain\Repository\CustomerInterface;
use DateTime;
use Ramsey\Uuid\Uuid;

class CreateCustomer
{
    private CustomerInterface $customerRepository;

    public function __construct(CustomerInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function execute($name, $email, $password): Customer
    {
        $customer = Customer::create(Uuid::uuid4()->toString(), $name, $email, $password, new DateTime());

        $this->customerRepository->save($customer);

        return $customer;
    }
}