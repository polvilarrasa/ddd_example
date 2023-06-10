<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Order;

interface OrderInterface
{
    /**
     * @param Order $order
     * @return Order
     */
    public function save(Order $order): Order;

    /**
     * @param string $orderId
     * @return Order|null
     */
    public function getOrderById(string $orderId): Order|null;

    /**
     * @return array
     */
    public function getOrders(): array;

    /**
     * @param string $orderId
     * @return bool
     */
    public function deleteOrder(string $orderId): bool;

    /**
     * @param string $customerId
     * @return array
     */
    public function getOrdersByCustomerId(string $customerId): array;
}