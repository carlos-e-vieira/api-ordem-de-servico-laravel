<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\AuthExceptions;

class AuthService
{
    public function getToken(array $credentials): mixed
    {
        $token = auth('api')->attempt($credentials);

        if (empty($token)) {
            throw new AuthExceptions('Erro ao gerar Token');
        }

        return $token;
    }
}
