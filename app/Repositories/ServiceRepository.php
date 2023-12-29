<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\AbstractRepository;

class ServiceRepository extends AbstractRepository
{
    public function __construct(Service $service)
    {
        parent::__construct($service);
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
