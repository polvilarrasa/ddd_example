<?php

namespace App\Application\Service\Order;

use App\Application\Presenter\Order\OrderToArrayPresenter;
use App\Domain\Exception\Customer\CustomerNotFoundException;
use App\Domain\Repository\CustomerInterface;
use App\Domain\Service\Order\CreateOrder;

class CreateOrderService
{
    private CreateOrder $createOrder;
    private CustomerInterface $customerRepository;

    public function __construct(CreateOrder $createOrder, CustomerInterface $customerRepository)
    {
        $this->createOrder = $createOrder;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @throws CustomerNotFoundException
     */
    public function execute(CreateOrderRequest $request, OrderToArrayPresenter $presenter): array
    {
        $customer = $this->customerRepository->getCustomerById($request->getCustomerId());
        if (is_null($customer)) {
            throw new CustomerNotFoundException($request->getCustomerId());
        }

        return $presenter->write($this->createOrder->execute($customer));
    }

}