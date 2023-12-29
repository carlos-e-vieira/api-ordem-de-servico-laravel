<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ServiceForSaleExceptions;
use App\Helpers\StatusMessage;
use App\Http\Resources\ServiceForSaleResource;
use App\Repositories\ServiceForSaleRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceForSaleService
{
    private ServiceForSaleRepository $serviceForSaleRepository;

    public function __construct(ServiceForSaleRepository $serviceForSaleRepository)
    {
        $this->serviceForSaleRepository = $serviceForSaleRepository;
    }

    public function getAllServicesForSale(array $filters): LengthAwarePaginator
    {
        $servicesForSalePaginated = $this->serviceForSaleRepository->getAll($filters);

        $this->checkEmpty($servicesForSalePaginated, StatusMessage::LIST_ERROR);

        return $servicesForSalePaginated;
    }

    public function saveServiceForSale(array $data): ServiceForSaleResource
    {
        $serviceForSale = $this->serviceForSaleRepository->save($data);

        $this->checkEmpty($serviceForSale, StatusMessage::CREATE_ERROR);

        return new ServiceForSaleResource($serviceForSale);
    }

    public function getServiceForSaleById(int $id): ServiceForSaleResource
    {
        $serviceForSale = $this->serviceForSaleRepository->getById($id);

        $this->checkEmpty($serviceForSale, StatusMessage::GET_ERROR);

        return new ServiceForSaleResource($serviceForSale);
    }

    public function updateServiceForSale(array $data, int $id): ServiceForSaleResource
    {
        $serviceForSale = $this->serviceForSaleRepository->update($data, $id);

        $this->checkEmpty($serviceForSale, StatusMessage::UPDATE_ERROR);

        return new ServiceForSaleResource($serviceForSale);
    }

    public function deleteServiceForSaleService(int $id): string
    {
        $message = $this->serviceForSaleRepository->delete($id);

        $this->checkEmpty($message, StatusMessage::DELETE_ERROR);

        return $message;
    }

    private function checkEmpty(mixed $data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new ServiceForSaleExceptions($errorMessage);
        }
    }
}
