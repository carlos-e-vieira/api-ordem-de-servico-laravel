<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\AuthExceptions;
use App\Helpers\Translator;

class AuthService
{
    public function getToken(array $credentials): mixed
    {
        $token = auth('api')->attempt($credentials);

        if (empty($token)) {
            throw new AuthExceptions(Translator::GENERATE_TOKEN_ERROR);
        }

        return $token;
    }
}
