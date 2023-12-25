<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;

class AuthExceptions extends OrchestratorException
{
    protected $errorStatuses = [
        'getToken' => Response::HTTP_FORBIDDEN,
    ];
}
