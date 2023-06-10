<?php

namespace App\Application\Service\Order;

use App\Application\Exception\Order\OrderIdIsNotValidUuidException;
use App\Shared\Utils;

class GetOrderByIdRequest
{
    private string $orderId;

    /**
     * @throws OrderIdIsNotValidUuidException
     */
    public function __construct(string $orderId)
    {
        $valid = Utils::validateUuid($orderId);
        if (!$valid) {
            throw new OrderIdIsNotValidUuidException($orderId);
        }
        $this->orderId = $orderId;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }
}