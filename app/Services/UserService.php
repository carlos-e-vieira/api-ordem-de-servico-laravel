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

        $this->checkEmpty($user, 'Erro ao listar cadastrar os dados do usuário');

        return $user;
    }

    private function checkEmpty(object $data, string $errorMessage): void
    {
        if (empty($data)) {
            throw new UserExceptions($errorMessage);
        }
    }
}
