<?php

namespace App\Infrastructure\Controller;

use App\Application\Exception\Customer\CustomerEmailIsNotValidException;
use App\Application\Exception\Customer\CustomerIdIsNotValidUuidException;
use App\Application\Exception\Customer\CustomerPasswordIsNotValidException;
use App\Application\Presenter\Customer\CustomerToArrayPresenter;
use App\Application\Service\Customer\CreateCustomerRequest;
use App\Application\Service\Customer\CreateCustomerService;
use App\Application\Service\Customer\UpdateCustomerFieldsRequest;
use App\Application\Service\Customer\UpdateCustomerFieldsService;
use App\Application\Service\Customer\UpdateCustomerPasswordRequest;
use App\Application\Service\Customer\UpdateCustomerPasswordService;
use App\Domain\Exception\Customer\CustomerNotFoundException;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/customer')]
class CustomerController extends AbstractController
{
    #[Route('/', name: 'create_customer', methods: ['POST'])]
    public function createCustomer(CreateCustomerService $createCustomerService, Request $request): Response
    {
        try {
            $createCustomerRequest = new CreateCustomerRequest(
                $request->get('name'),
                $request->get('email'),
                $request->get('password')
            );

            $order = $createCustomerService->execute($createCustomerRequest, new CustomerToArrayPresenter());

            $response = new Response(json_encode($order), Response::HTTP_CREATED);
        } catch (CustomerEmailIsNotValidException) {
            $response = new Response("Email is not valid", Response::HTTP_BAD_REQUEST);
        } catch (CustomerPasswordIsNotValidException) {
            $response = new Response("Password is not valid", Response::HTTP_BAD_REQUEST);
        } catch (Exception) {
            $response = new Response("Internal server error", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }

    #[Route('/{customerId}', name: 'get_customer_by_id', methods: ['GET'])]
    public function getCustomer(CreateCustomerService $createCustomerService, Request $request): Response
    {
        try {
            $createCustomerRequest = new CreateCustomerRequest(
                $request->get('name'),
                $request->get('email'),
                $request->get('password')
            );

            $order = $createCustomerService->execute($createCustomerRequest, new CustomerToArrayPresenter());

            $response = new Response(json_encode($order), Response::HTTP_CREATED);
        } catch (Exception) {
            $response = new Response("Internal server error", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }

    #[Route('/{customerId}', name: 'update_customer_password', methods: ['PATCH'])]
    public function updateCustomerPassword(
        string $customerId,
        UpdateCustomerPasswordService $service,
        Request $request
    ): Response
    {
        try {
            $updatePasswordRequest = new UpdateCustomerPasswordRequest($customerId, $request->get('newPassword'));
            $updatedCustomer = $service->execute($updatePasswordRequest, new CustomerToArrayPresenter());
            $response = new Response(json_encode($updatedCustomer), Response::HTTP_OK);
        } catch (CustomerNotFoundException) {
            $response = new Response("Customer not found", Response::HTTP_NOT_FOUND);
        } catch (CustomerPasswordIsNotValidException) {
            $response = new Response("Customer password is not valid", Response::HTTP_BAD_REQUEST);
        } catch (CustomerIdIsNotValidUuidException) {
            $response = new Response("Customer id is not valid", Response::HTTP_BAD_REQUEST);
        } catch (Exception) {
            $response = new Response("Internal server error", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }

    #[Route('/{customerId}', name: 'update_customer_fields', methods: ['PUT'])]
    public function updateCustomerFields(
        string $customerId,
        UpdateCustomerFieldsService $service,
        Request $request
    ): Response
    {
        try {
            $updateCustomerFieldsRequest = new UpdateCustomerFieldsRequest(
                $customerId,
                $request->get('name'),
                $request->get('email')
            );

            $updatedCustomer = $service->execute($updateCustomerFieldsRequest, new CustomerToArrayPresenter());
            $response = new Response(json_encode($updatedCustomer), Response::HTTP_OK);
        } catch (CustomerEmailIsNotValidException $e) {
            $response = new Response("Customer email is not valid", Response::HTTP_BAD_REQUEST);
        } catch (CustomerIdIsNotValidUuidException $e) {
            $response = new Response("Customer id is not valid", Response::HTTP_BAD_REQUEST);
        } catch (Exception) {
            $response = new Response("Internal server error", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }
}