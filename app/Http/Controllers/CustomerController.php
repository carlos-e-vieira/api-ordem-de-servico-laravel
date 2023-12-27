<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CustomerFormRequest;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(CustomerFormRequest $customerFormRequest): JsonResponse
    {
        $response = $this->customerService->getAllCustomers($customerFormRequest->toArray());

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function store(CustomerFormRequest $customerFormRequest): JsonResponse
    {
        $requestData = $customerFormRequest->only('name', 'document_type', 'document_number', 'email', 'phone', 'company');
        
        $response = $this->customerService->saveCustomer($requestData);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->customerService->getCustomerById($id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function update(CustomerFormRequest $customerFormRequest, int $id): JsonResponse
    {
        $requestData = $customerFormRequest->only('name', 'document_type', 'document_number', 'email', 'phone', 'company');

        $response = $this->customerService->updateCustomer($requestData, $id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->customerService->deleteCustomer($id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }
}
