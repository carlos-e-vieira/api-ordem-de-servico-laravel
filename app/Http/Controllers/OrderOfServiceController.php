<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\OrderOfServiceFormRequest;
use App\Services\OrderOfServiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OrderOfServiceController extends Controller
{
    private OrderOfServiceService $orderOfServiceService;

    public function __construct(OrderOfServiceService $orderOfServiceService)
    {
        $this->orderOfServiceService = $orderOfServiceService;
    }

    public function index(OrderOfServiceFormRequest $orderOfServiceFormRequest): JsonResponse
    {
        $response = $this->orderOfServiceService->getAllOrdersOfService($orderOfServiceFormRequest->toArray());

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function store(OrderOfServiceFormRequest $orderOfServiceFormRequest): JsonResponse
    {
        $requestData = $orderOfServiceFormRequest->only('customer_id', 'service_id', 'status');

        $response = $this->orderOfServiceService->saveOrderOfService($requestData);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->orderOfServiceService->getOrderOfServiceById($id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function update(OrderOfServiceFormRequest $orderOfServiceFormRequest, int $id): JsonResponse
    {
        $requestData = $orderOfServiceFormRequest->only('customer_id', 'service_id', 'status');

        $response = $this->orderOfServiceService->updateOrderOfService($requestData, $id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->orderOfServiceService->deleteOrderOfService($id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }
}
