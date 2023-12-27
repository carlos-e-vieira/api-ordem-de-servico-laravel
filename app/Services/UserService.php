<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UserExceptions;
use App\Helpers\Translator;
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

        return $users;
    }

    public function saveUser(array $data): object
    {
        $user = $this->userRepository->save($data);

        $this->checkEmpty($user, Translator::CREATE_ERROR);

        return $user;
    }

    public function getUserById(int $id): object
    {
        $user = $this->userRepository->getById($id);

        $this->checkEmpty($user, Translator::GET_ERROR);

        return $user;
    }

    public function updateUser(array $data, int $id): object
    {
        $user = $this->userRepository->update($data, $id);

        $this->checkEmpty($user, Translator::UPDATE_ERROR);

        return $user;
    }

    public function deleteUser(int $id): string
    {
        $message = $this->userRepository->delete($id);

        $this->checkEmpty($message, Translator::DELETE_ERROR);

        return $message;
    }

    private function checkEmpty(mixed $data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new UserExceptions($errorMessage);
        }
    }
}
