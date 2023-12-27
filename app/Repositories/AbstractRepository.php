<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Helpers\Translator;
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
        try {
            $query = $this->model::query();

            $this->applyFilters($query, $filters);

            $results = $query->orderBy('created_at', 'desc')->paginate(15);

            return $results;
        } catch (\Exception $e) {
            Log::error(Translator::LIST_ERROR . $e->getMessage());

            return null;
        }
    }

    abstract protected function applyFilters($query, array $filters);

    public function save(array $data): ?Model
    {
        try {
            $model = $this->model->create($data);

            return $model;
        } catch (\Exception $e) {
            Log::error(Translator::CREATE_ERROR . $e->getMessage());

            return null;
        }
    }

    public function getById(int $id): ?Model
    {
        try {
            return $this->model->find($id);
        } catch (\Exception $e) {
            Log::error(Translator::GET_ERROR . $e->getMessage());

            return null;
        }
    }

    public function update(array $data, int $id): ?Model
    {
        try {
            $this->model->findOrFail($id)->update($data);

            return $this->getById($id);
        } catch (\Exception $e) {
            Log::error(Translator::UPDATE_ERROR . $e->getMessage());

            return null;
        }
    }

    public function delete(int $id): ?string
    {
        try {
            $this->model->findOrFail($id)->delete();

            return Translator::DELETE_SUCCESS;
        } catch (\Exception $e) {
            Log::error(Translator::DELETE_ERROR . $e->getMessage());

            return null;
        }
    }
}
