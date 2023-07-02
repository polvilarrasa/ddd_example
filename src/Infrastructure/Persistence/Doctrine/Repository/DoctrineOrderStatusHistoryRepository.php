<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Entity\OrderStatusHistory;
use App\Domain\Repository\OrderStatusHistoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;

class DoctrineOrderStatusHistoryRepository extends EntityRepository implements OrderStatusHistoryInterface
{
    private EntityManagerInterface $em;
    private ObjectRepository $repository;
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(OrderStatusHistory::class));
        $this->em = $em;
        $this->repository = $this->em->getRepository(OrderStatusHistory::class);
    }

    /**
     * @inheritDoc
     */
    public function save(OrderStatusHistory $orderStatusHistory): OrderStatusHistory
    {
        $this->em->persist($orderStatusHistory);
        $this->em->flush();
        return $orderStatusHistory;
    }

    /**
     * @inheritDoc
     */
    public function getById(string $id): OrderStatusHistory
    {
        return $this->repository->find($id);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderId(string $orderId): array
    {
        return $this->repository->findBy(['order' => $orderId]);
    }
}