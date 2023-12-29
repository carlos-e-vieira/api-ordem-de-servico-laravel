<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ServiceExceptions;
use App\Helpers\StatusMessage;
use App\Http\Resources\ServiceResource;
use App\Repositories\ServiceRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceService
{
    private ServiceRepository $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function getAllServices(array $filters): LengthAwarePaginator
    {
        $servicesPaginated = $this->serviceRepository->getAll($filters);

        $this->checkEmpty($servicesPaginated, StatusMessage::LIST_ERROR);

        return $servicesPaginated;
    }

    public function saveService(array $data): ServiceResource
    {
        $service = $this->serviceRepository->save($data);

        $this->checkEmpty($service, StatusMessage::CREATE_ERROR);

        return new ServiceResource($service);
    }

    public function getServiceById(int $id): ServiceResource
    {
        $service = $this->serviceRepository->getById($id);

        $this->checkEmpty($service, StatusMessage::GET_ERROR);

        return new ServiceResource($service);
    }

    public function updateService(array $data, int $id): ServiceResource
    {
        $service = $this->serviceRepository->update($data, $id);

        $this->checkEmpty($service, StatusMessage::UPDATE_ERROR);

        return new ServiceResource($service);
    }

    public function deleteService(int $id): string
    {
        $message = $this->serviceRepository->delete($id);

        $this->checkEmpty($message, StatusMessage::DELETE_ERROR);

        return $message;
    }

    private function checkEmpty(mixed $data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new ServiceExceptions($errorMessage);
        }
    }
}
