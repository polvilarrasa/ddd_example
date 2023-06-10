<?php

namespace App\Application\Exception\Order;

use Exception;

class OrderIdIsNotValidUuidException extends Exception
{
    public function __construct(string $orderId)
    {
        parent::__construct("Order id $orderId is not valid uuid");
    }
}