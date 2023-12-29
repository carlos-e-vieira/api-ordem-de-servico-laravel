<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ServiceForSaleFormRequest;
use App\Services\ServiceForSaleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ServiceForSaleController extends Controller
{
    private ServiceForSaleService $serviceForSaleService;

    public function __construct(ServiceForSaleService $serviceForSaleService)
    {
        $this->serviceForSaleService = $serviceForSaleService;
    }

    public function index(ServiceForSaleFormRequest $serviceForSaleFormRequest): JsonResponse
    {
        $response = $this->serviceForSaleService->getAllServicesForSale($serviceForSaleFormRequest->toArray());

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function store(ServiceForSaleFormRequest $serviceForSaleFormRequest): JsonResponse
    {
        $requestData = $serviceForSaleFormRequest->only('title', 'price');

        $response = $this->serviceForSaleService->saveServiceForSale($requestData);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->serviceForSaleService->getServiceForSaleById($id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function update(ServiceForSaleFormRequest $serviceForSaleFormRequest, int $id): JsonResponse
    {
        $requestData = $serviceForSaleFormRequest->only('title', 'price');

        $response = $this->serviceForSaleService->updateServiceForSale($requestData, $id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->serviceForSaleService->deleteServiceForSaleService($id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }
}
