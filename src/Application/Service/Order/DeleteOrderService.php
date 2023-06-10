<?php

namespace App\Application\Service\Order;

use App\Domain\Repository\OrderInterface;
use App\Infrastructure\Exception\Order\OrderNotFoundException;

class DeleteOrderService
{
    private OrderInterface $orderRepository;

    public function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @throws OrderNotFoundException
     */
    public function execute(DeleteOrderRequest $request): void
    {
        $this->orderRepository->deleteOrder($request->getOrderId());
    }
}