<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Order;
use App\Domain\Entity\OrderStatusHistory;
use App\Infrastructure\Exception\Order\OrderNotFoundException;

interface OrderStatusHistoryInterface
{
    /**
     * @param OrderStatusHistory $orderStatusHistory
     * @return OrderStatusHistory
     */
    public function save(OrderStatusHistory $orderStatusHistory): OrderStatusHistory;

    /**
     * @param string $id
     * @return OrderStatusHistory
     */
    public function getById(string $id): OrderStatusHistory;

    /**
     * @param string $orderId
     * @return array
     */
    public function getByOrderId(string $orderId): array;
}