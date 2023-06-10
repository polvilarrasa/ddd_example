<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Entity\Order;
use App\Domain\Repository\OrderInterface;
use App\Infrastructure\Exception\Order\OrderNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
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

    /**
     * @throws OrderNotFoundException
     */
    public function deleteOrder(string $orderId): void
    {
        $order = $this->repository->find($orderId);
        if (!$order) {
            throw new OrderNotFoundException($orderId);
        }
        $this->em->remove($order);
        $this->em->flush();
    }

    public function getOrdersByCustomerId(string $customerId): array
    {
        return $this->repository->findBy(['customer' => $customerId]);
    }
}