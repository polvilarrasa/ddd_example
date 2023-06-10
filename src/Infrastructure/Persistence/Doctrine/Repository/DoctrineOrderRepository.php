<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Entity\Order;
use App\Domain\Repository\OrderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectRepository;

class DoctrineOrderRepository extends EntityRepository implements OrderInterface
{
    private EntityManagerInterface $em;
    private ObjectRepository $repository;
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Order::class));
        $this->em = $em;
        $this->repository = $this->em->getRepository(Order::class);
    }

    public function save(Order $order): Order
    {
        $this->em->persist($order);
        $this->em->flush();
        return $order;
    }

    public function getOrderById(string $orderId): Order|null
    {
        return $this->repository->find($orderId);
    }

    public function getOrders(): array
    {
        return $this->repository->findAll();
    }

    public function deleteOrder(string $orderId): bool
    {
        $order = $this->repository->find($orderId);
        if (!$order) {
            return false;
        }
        $this->em->remove($order);
        $this->em->flush();
        return true;
    }

    public function getOrdersByCustomerId(string $customerId): array
    {
        return $this->repository->findBy(['customer' => $customerId]);
    }
}