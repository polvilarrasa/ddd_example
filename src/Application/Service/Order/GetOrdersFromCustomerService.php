<?php

namespace App\Application\Service\Order;

use App\Domain\Exception\Customer\CustomerNotFoundException;
use App\Domain\Repository\CustomerInterface;
use App\Domain\Repository\OrderInterface;

class GetOrdersFromCustomerService
{
    private OrderInterface $orderRepository;
    private CustomerInterface $customerRepository;

    public function __construct(OrderInterface $orderRepository, CustomerInterface $customerRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @throws CustomerNotFoundException
     */
    public function execute(GetOrdersFromCustomerRequest $request): array
    {
        $customer = $this->customerRepository->getCustomerById($request->getCustomerId());
        if (is_null($customer)) {
            throw new CustomerNotFoundException($request->getCustomerId());
        }

        return $this->orderRepository->getOrdersByCustomerId($customer->getId());
    }
}