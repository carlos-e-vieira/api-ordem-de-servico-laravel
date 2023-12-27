<?php

declare(strict_types=1);

namespace App\Repositories;

class CustomerRepository extends AbstractRepository
{
    protected function applyFilters($query, array $filters): void
    {
        $filtersQuery = [
            'name' => $filters['name'] ?? '',
            'document_number' => $filters['document_number'] ?? '',
            'email' => $filters['email'] ?? '',
            'company' => $filters['company'] ?? '',
        ];

        if (!empty($filters)) {
            $query->where([
                ['name', 'LIKE', '%' . $filtersQuery['name'] . '%'],
                ['document_number', 'LIKE', '%' . $filtersQuery['document_number'] . '%'],
                ['email', 'LIKE', '%' . $filtersQuery['email'] . '%'],
                ['company', 'LIKE', '%' . $filtersQuery['company'] . '%'],
            ]);
        }
    }
}
