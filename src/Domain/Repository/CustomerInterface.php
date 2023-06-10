<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Customer;

interface CustomerInterface
{
    /**
     * @param Customer $customer
     * @return Customer
     */
    public function save(Customer $customer): Customer;

    /**
     * @param string $customerId
     * @return Customer|null
     */
    public function getCustomerById(string $customerId): Customer|null;

    /**
     * @return array
     */
    public function getCustomers(): array;

    /**
     * @param string $customerId
     * @return bool
     */
    public function deleteCustomer(string $customerId): bool;
}