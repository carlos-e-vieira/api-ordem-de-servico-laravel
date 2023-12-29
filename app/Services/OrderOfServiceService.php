<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\OrderOfServiceExceptions;
use App\Helpers\StatusMessage;
use App\Http\Resources\OrderOfServiceResource;
use App\Repositories\OrderOfServiceRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderOfServiceService
{
    private OrderOfServiceRepository $orderOfServiceRepository;

    public function __construct(OrderOfServiceRepository $orderOfServiceRepository)
    {
        $this->orderOfServiceRepository = $orderOfServiceRepository;
    }

    public function getAllOrdersOfService(array $filters): LengthAwarePaginator
    {
        $ordersOfServicePaginated = $this->orderOfServiceRepository->getAll($filters);

        $this->checkEmpty($ordersOfServicePaginated, StatusMessage::LIST_ERROR);

        return $ordersOfServicePaginated;
    }

    public function saveOrderOfService(array $data): OrderOfServiceResource
    {
        $userId = ['user_id' => auth()->user()->id];

        $orderOfService = $this->orderOfServiceRepository->save(array_merge($userId, $data));

        $this->checkEmpty($orderOfService, StatusMessage::CREATE_ERROR);

        return new OrderOfServiceResource($orderOfService);
    }

    public function getOrderOfServiceById(int $id): OrderOfServiceResource
    {
        $orderOfService = $this->orderOfServiceRepository->getById($id);

        $this->checkEmpty($orderOfService, StatusMessage::GET_ERROR);

        return new OrderOfServiceResource($orderOfService);
    }

    public function updateOrderOfService(array $data, int $id): OrderOfServiceResource
    {
        $orderOfService = $this->orderOfServiceRepository->update($data, $id);

        $this->checkEmpty($orderOfService, StatusMessage::UPDATE_ERROR);

        return new OrderOfServiceResource($orderOfService);
    }

    public function deleteOrderOfService(int $id): string
    {
        $message = $this->orderOfServiceRepository->delete($id);

        $this->checkEmpty($message, StatusMessage::DELETE_ERROR);

        return $message;
    }

    private function checkEmpty(mixed $data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new OrderOfServiceExceptions($errorMessage);
        }
    }
}
