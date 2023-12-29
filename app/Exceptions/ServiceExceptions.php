<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;

class ServiceExceptions extends OrchestratorException
{
    protected $errorStatuses = [
        'getAllServices' => Response::HTTP_NOT_FOUND,
        'saveService' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getServiceById' => Response::HTTP_NOT_FOUND,
        'updateService' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteService' => Response::HTTP_NOT_FOUND,
    ];
}
