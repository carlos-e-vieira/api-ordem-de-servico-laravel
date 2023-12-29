<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ServiceFormRequest;
use App\Services\ServiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    private ServiceService $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index(ServiceFormRequest $serviceFormRequest): JsonResponse
    {
        $response = $this->serviceService->getAllServices($serviceFormRequest->toArray());

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function store(ServiceFormRequest $serviceFormRequest): JsonResponse
    {
        $requestData = $serviceFormRequest->only('title', 'price');

        $response = $this->serviceService->saveService($requestData);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->serviceService->getServiceById($id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function update(ServiceFormRequest $serviceFormRequest, int $id): JsonResponse
    {
        $requestData = $serviceFormRequest->only('title', 'price');

        $response = $this->serviceService->updateService($requestData, $id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->serviceService->deleteService($id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }
}
