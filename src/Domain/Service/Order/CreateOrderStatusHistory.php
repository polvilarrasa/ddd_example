<?php

namespace App\Domain\Service\Order;

use App\Domain\Entity\Customer;
use App\Domain\Entity\Order;
use App\Domain\Entity\OrderStatusHistory;
use App\Domain\Repository\OrderInterface;
use App\Domain\Repository\OrderStatusHistoryInterface;
use DateTime;
use Ramsey\Uuid\Uuid;

class CreateOrderStatusHistory
{
    private OrderStatusHistoryInterface $orderStatusHistoryRepository;

    public function __construct(OrderStatusHistoryInterface $orderStatusHistoryRepository)
    {
        $this->orderStatusHistoryRepository = $orderStatusHistoryRepository;
    }

    public function execute(Order $order, string $status): OrderStatusHistory
    {
        $history = OrderStatusHistory::create(Uuid::uuid4()->toString(), $status, $order);

        return $this->orderStatusHistoryRepository->save($history);
    }

}