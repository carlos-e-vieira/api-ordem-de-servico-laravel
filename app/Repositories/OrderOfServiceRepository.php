<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\OrderOfService;
use App\Repositories\AbstractRepository;

class OrderOfServiceRepository extends AbstractRepository
{
    public function __construct(OrderOfService $orderOfService)
    {
        parent::__construct($orderOfService);
    }

    protected function applyFilters($query, array $filters): void
    {
        $filtersQuery = [
            'user_id' => $filters['user_id'] ?? '',
            'customer_id' => $filters['customer_id'] ?? '',
            'service_id' => $filters['service_id'] ?? '',
            'status' => $filters['status'] ?? '',
        ];

        if (!empty($filtersQuery)) {
            $query->where([
                ['user_id', 'LIKE', '%' . $filtersQuery['user_id'] . '%'],
                ['customer_id', 'LIKE', '%' . $filtersQuery['customer_id'] . '%'],
                ['service_id', 'LIKE', '%' . $filtersQuery['service_id'] . '%'],
                ['status', 'LIKE', '%' . $filtersQuery['status'] . '%'],
            ]);
        }
    }
}
