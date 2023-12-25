<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

abstract class AbstractRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(array $filters): ?LengthAwarePaginator
    {
        $query = $this->model::query();

        $this->applyFilters($query, $filters);

        $results = $query->orderBy('created_at', 'desc')->paginate(15);

        return $results;
    }

    abstract protected function applyFilters($query, array $filters);

    public function save(array $data): ?Model
    {
        try {
            $model = $this->model->create($data);

            return $model;
        } catch (\Exception $e) {
            Log::error('Erro ao salvar os dados: ' . $e->getMessage());

            return null;
        }
    }
}
