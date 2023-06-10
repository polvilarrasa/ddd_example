<?php

namespace App\Infrastructure\Controller;

use App\Application\Exception\Customer\CustomerIdIsNotValidUuidException;
use App\Application\Exception\Order\OrderIdIsNotValidUuidException;
use App\Application\Presenter\Order\OrderToArrayPresenter;
use App\Application\Service\Order\CreateOrderRequest;
use App\Application\Service\Order\CreateOrderService;
use App\Application\Service\Order\DeleteOrderRequest;
use App\Application\Service\Order\DeleteOrderService;
use App\Application\Service\Order\GetOrderByIdRequest;
use App\Application\Service\Order\GetOrderByIdService;
use App\Domain\Exception\Customer\CustomerNotFoundException;
use App\Domain\Exception\Order\OrderNotFoundException;
use App\Infrastructure\Exception\Order\OrderNotFoundException as InfrastructureOrderNotFoundException;
use Exception;
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
        } catch (CustomerIdIsNotValidUuidException) {
            $response = new Response("Customer id is not valid uuid", Response::HTTP_BAD_REQUEST);
        } catch (CustomerNotFoundException) {
            $response = new Response("Customer not found", Response::HTTP_NOT_FOUND);
        } catch (Exception) {
            $response = new Response("Internal server error", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }

    #[Route('/{id}', name: 'get_order_by_id', methods: ['GET'])]
    public function getOrder(string $id, GetOrderByIdService $service): Response
    {
        try {
            $order = $service->execute(new GetOrderByIdRequest($id), new OrderToArrayPresenter());
            $response = new Response(json_encode($order), Response::HTTP_OK);
        } catch (OrderIdIsNotValidUuidException) {
            $response = new Response("Order id is not valid uuid", Response::HTTP_BAD_REQUEST);
        } catch (OrderNotFoundException) {
            $response = new Response("Order not found", Response::HTTP_NOT_FOUND);
        } catch (Exception) {
            $response = new Response("Internal server error", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }

    #[Route('/{id}', name: 'delete_order_by_id', methods: ['DELETE'])]
    public function deleteOrder(string $id, DeleteOrderService $deleteOrderService): Response
    {
        try {
            $deleteOrderService->execute(new DeleteOrderRequest($id));
            $response = new Response("Order deleted", Response::HTTP_NO_CONTENT);
        } catch (OrderIdIsNotValidUuidException) {
            $response = new Response("Order id is not valid uuid", Response::HTTP_BAD_REQUEST);
        } catch (InfrastructureOrderNotFoundException) {
            $response = new Response("Order not found", Response::HTTP_NOT_FOUND);
        } catch (Exception) {
            $response = new Response("Internal server error", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }
}