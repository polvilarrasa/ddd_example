<?php

namespace App\Domain\Exception\Order;

use Exception;

class OrderNotFoundException extends Exception
{
    public function __construct(string $orderId)
    {
        parent::__construct("Order with id: $orderId not found.");
    }
}