<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    private User $user;

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    protected function applyFilters($query, array $filters): void
    {
        $filtersQuery = [
            'name' => $filters['name'] ?? '',
            'email' => $filters['email'] ?? '',
        ];
    
        if (!empty($filtersQuery)) {
            $query->where([
                ['name', 'LIKE', '%' . $filtersQuery['name'] . '%'],
                ['email', 'LIKE', '%' . $filtersQuery['email'] . '%'],
            ]);
        }
    }
}
