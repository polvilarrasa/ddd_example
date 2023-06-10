<?php

namespace App\Application\Service\Order;

use App\Application\Presenter\Order\OrderToArrayPresenter;
use App\Domain\Exception\Order\OrderNotFoundException;
use App\Domain\Repository\OrderInterface;

class GetOrderByIdService
{
    private OrderInterface $orderRepository;

    public function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @throws OrderNotFoundException
     */
    public function execute(GetOrderByIdRequest $request, OrderToArrayPresenter $presenter): array
    {
        $order = $this->orderRepository->getOrderById($request->getOrderId());
        if (is_null($order)) {
            throw new OrderNotFoundException($request->getOrderId());
        }

        return $presenter->write($order);
    }
}