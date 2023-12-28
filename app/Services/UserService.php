<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UserExceptions;
use App\Helpers\StatusMessage;
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
        $usersPaginated = $this->userRepository->getAll($filters);

        $this->checkEmpty($usersPaginated, StatusMessage::LIST_ERROR);

        return $usersPaginated;
    }

    public function saveUser(array $data): UserResource
    {
        $user = $this->userRepository->save($data);

        $this->checkEmpty($user, StatusMessage::CREATE_ERROR);

        return new UserResource($user);
    }

    public function getUserById(int $id): UserResource
    {
        $user = $this->userRepository->getById($id);

        $this->checkEmpty($user, StatusMessage::GET_ERROR);

        return new UserResource($user);
    }

    public function updateUser(array $data, int $id): UserResource
    {
        $user = $this->userRepository->update($data, $id);

        $this->checkEmpty($user, StatusMessage::UPDATE_ERROR);

        return new UserResource($user);
    }

    public function deleteUser(int $id): string
    {
        $message = $this->userRepository->delete($id);

        $this->checkEmpty($message, StatusMessage::DELETE_ERROR);

        return $message;
    }

    private function checkEmpty(mixed $data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new UserExceptions($errorMessage);
        }
    }
}
