<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Entity\Customer;
use App\Domain\Repository\CustomerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;

class DoctrineCustomerRepository extends EntityRepository implements CustomerInterface
{
    private EntityManagerInterface $em;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Customer::class));
        $this->em = $em;
        $this->repository = $this->em->getRepository(Customer::class);
    }

    public function save(Customer $customer): Customer
    {
        $this->em->persist($customer);
        $this->em->flush();
        return $customer;
    }

    public function getCustomerById(string $customerId): Customer|null
    {
        return $this->repository->find($customerId);
    }

    public function getCustomers(): array
    {
        return $this->repository->findAll();
    }

    public function deleteCustomer(string $customerId): bool
    {
        $customer = $this->repository->find($customerId);
        if (!$customer) {
            return false;
        }
        $this->em->remove($customer);
        $this->em->flush();
        return true;
    }
}