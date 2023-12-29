<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ServiceForSale;
use App\Repositories\AbstractRepository;

class ServiceForSaleRepository extends AbstractRepository
{
    public function __construct(ServiceForSale $serviceForSale)
    {
        parent::__construct($serviceForSale);
    }

    protected function applyFilters($query, array $filters): void
    {
        $filtersQuery = [
            'title' => $filters['title'] ?? ''
        ];

        if (!empty($filtersQuery)) {
            $query->where([
                ['title', 'LIKE', '%' . $filtersQuery['title'] . '%']
            ]);
        }
    }
}
