<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Order;
use App\Infrastructure\Exception\Order\OrderNotFoundException;

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
     * @throws OrderNotFoundException
     * @return void
     */
    public function deleteOrder(string $orderId): void;

    /**
     * @param string $customerId
     * @return array
     */
    public function getOrdersByCustomerId(string $customerId): array;
}