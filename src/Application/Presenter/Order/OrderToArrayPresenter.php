<?php

namespace App\Application\Presenter\Order;

use App\Domain\Entity\Order;

class OrderToArrayPresenter
{
    public function write(Order $order): array
    {
        return [
            'id' => $order->getId(),
            'createdAt' => $order->getCreatedAt()->format('Y-m-d H:i:s'),
            'customerId' => (string) $order->getCustomer()
        ];
    }
}