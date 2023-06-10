<?php

namespace App\Infrastructure\Exception\Order;

use Exception;

class OrderNotFoundException extends Exception
{
    public function __construct(string $orderId)
    {
        parent::__construct(sprintf('Order with id %s not found', $orderId));
    }
}