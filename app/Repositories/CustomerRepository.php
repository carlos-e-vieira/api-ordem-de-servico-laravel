<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository extends AbstractRepository
{
    public function __construct(Customer $customer)
    {
        parent::__construct($customer);
    }

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
