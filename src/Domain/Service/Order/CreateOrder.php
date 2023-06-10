<?php

namespace App\Domain\Service\Order;

use App\Domain\Entity\Customer;
use App\Domain\Entity\Order;
use App\Domain\Repository\OrderInterface;
use DateTime;
use Ramsey\Uuid\Uuid;

class CreateOrder
{
    private OrderInterface $orderRepository;

    public function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(Customer $customer): Order
    {
        $order = Order::create(Uuid::uuid4()->toString(), new DateTime(), $customer);

        return $this->orderRepository->save($order);
    }

}