<?php

namespace App\Domain\Entity;

use DateTime;

class OrderStatusHistory
{
    CONST STATUS_CREATED = 'created';
    CONST STATUS_PAID = 'paid';
    CONST STATUS_CANCELLED = 'cancelled';
    CONST STATUS_REFUNDED = 'refunded';

    private string $id;
    private string $status;
    private DateTime $timestamp;
    private Order $order;

    private function __construct(string $id, string $status, DateTime $timestamp, Order $order)
    {
        $this->id = $id;
        $this->status = $status;
        $this->timestamp = $timestamp;
        $this->order = $order;
    }

    public static function create(string $id, string $status, Order $order): self
    {
        return new self($id, $status, new DateTime(), $order);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

}
