<?php

namespace App\Infrastructure\Controller;

use App\Application\Exception\Customer\CustomerIdIsNotValidUuidException;
use App\Application\Presenter\Order\OrderToArrayPresenter;
use App\Application\Service\Order\CreateOrderRequest;
use App\Application\Service\Order\CreateOrderService;
use App\Domain\Exception\Customer\CustomerNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/order')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'create_order', methods: ['POST'])]
    public function createOrder(CreateOrderService $createOrderService, Request $request): Response
    {
        $customerId = $request->get('customerId');

        try {
            $order = $createOrderService->execute(new CreateOrderRequest($customerId), new OrderToArrayPresenter());
            $response = new Response(json_encode($order), Response::HTTP_CREATED);
        } catch (CustomerIdIsNotValidUuidException $e) {
            $response = new Response("Customer id is not valid uuid", Response::HTTP_BAD_REQUEST);
        } catch (CustomerNotFoundException $e) {
            $response = new Response("Customer not found", Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            $response = new Response("Internal server error", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }

    #[Route('/{id}', name: 'get_order_by_id', methods: ['GET'])]
    public function getOrder(): Response
    {

    }
}