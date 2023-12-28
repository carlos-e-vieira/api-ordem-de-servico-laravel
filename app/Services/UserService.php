<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UserExceptions;
use App\Helpers\Translator;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(array $filters): LengthAwarePaginator
    {
        $users = $this->userRepository->getAll($filters);

        $this->checkEmpty($users, Translator::LIST_ERROR);

        return UserResource::collection($users);
    }

    public function saveUser(array $data): UserResource
    {
        $user = $this->userRepository->save($data);

        $this->checkEmpty($user, Translator::CREATE_ERROR);

        return new UserResource($user);
    }

    public function getUserById(int $id): UserResource
    {
        $user = $this->userRepository->getById($id);

        $this->checkEmpty($user, Translator::GET_ERROR);

        return new UserResource($user);
    }

    public function updateUser(array $data, int $id): UserResource
    {
        $user = $this->userRepository->update($data, $id);

        $this->checkEmpty($user, Translator::UPDATE_ERROR);

        return new UserResource($user);
    }

    public function deleteUser(int $id): string
    {
        $response = $this->userRepository->delete($id);

        $this->checkEmpty($response, Translator::DELETE_ERROR);

        return Translator::DELETE_SUCCESS;
    }

    private function checkEmpty(mixed $data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new UserExceptions($errorMessage);
        }
    }
}
