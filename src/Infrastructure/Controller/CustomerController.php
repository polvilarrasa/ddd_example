<?php

namespace App\Infrastructure\Controller;

use App\Application\Exception\Customer\CustomerIdIsNotValidUuidException;
use App\Application\Presenter\Customer\CustomerToArrayPresenter;
use App\Application\Service\Customer\CreateCustomerRequest;
use App\Application\Service\Customer\CreateCustomerService;
use App\Domain\Exception\Customer\CustomerNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/customer')]
class CustomerController extends AbstractController
{
    #[Route('/', name: 'customer', methods: ['POST'])]
    public function createCustomer(CreateCustomerService $createCustomerService, Request $request): Response
    {
        try {
            $createCustomerRequest = new CreateCustomerRequest(
                $request->get('customerId'),
                $request->get('name'),
                $request->get('email'),
                $request->get('password')
            );

            $order = $createCustomerService->execute($createCustomerRequest, new CustomerToArrayPresenter());

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
}