<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;

class UserExceptions extends OrchestratorException
{
    protected $errorStatuses = [
        'getAllUsers' => Response::HTTP_NOT_FOUND,
        'saveUser' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getUserById' => Response::HTTP_NOT_FOUND,
        'updateUser' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteUser' => Response::HTTP_NOT_FOUND,
        'resetUserPassword' => Response::HTTP_UNPROCESSABLE_ENTITY
    ];
}
