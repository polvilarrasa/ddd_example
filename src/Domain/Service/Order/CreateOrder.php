<?php

namespace App\Domain\Service\Order;

use App\Domain\Entity\Customer;
use App\Domain\Entity\Order;
use App\Domain\Entity\OrderStatusHistory;
use App\Domain\Repository\OrderInterface;
use DateTime;
use Ramsey\Uuid\Uuid;

class CreateOrder
{
    private CreateOrderStatusHistory $createOrderStatusHistory;
    private OrderInterface $orderRepository;

    public function __construct(CreateOrderStatusHistory $createOrderStatusHistory, OrderInterface $orderRepository)
    {
        $this->createOrderStatusHistory = $createOrderStatusHistory;
        $this->orderRepository = $orderRepository;
    }

    public function execute(Customer $customer): Order
    {
        $order = Order::create(Uuid::uuid4()->toString(), new DateTime(), $customer);
        $this->orderRepository->save($order);

        $this->createOrderStatusHistory->execute($order, OrderStatusHistory::STATUS_CREATED);

        return $order;
    }

}