<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UserExceptions;
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

        $this->checkEmpty($users, 'Erro ao listar todos os registros de usuários');

        return $users;
    }

    public function saveUser(array $data): object
    {
        $user = $this->userRepository->save($data);

        $this->checkEmpty($user, 'Erro ao cadastrar os dados do usuário');

        return $user;
    }

    public function getUserById(int $id): object
    {
        $user = $this->userRepository->getById($id);

        $this->checkEmpty($user, 'Erro ao buscar os dados do usuário');

        return $user;
    }

    public function updateUser(array $data, int $id): object
    {
        $user = $this->userRepository->update($data, $id);

        $this->checkEmpty($user, 'Erro ao atualizar os dados do usuário');

        return $user;
    }

    public function deleteUser(int $id): object
    {
        $message = $this->userRepository->delete($id);

        $this->checkEmpty($message, 'Erro ao deletar os dados do usuário');

        return $message;
    }

    private function checkEmpty($data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new UserExceptions($errorMessage);
        }
    }
}
