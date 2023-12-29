<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;

class OrderOfServiceExceptions extends OrchestratorException
{
    protected $errorStatuses = [
        'getAllOrdersOfService' => Response::HTTP_NOT_FOUND,
        'saveOrderOfService' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getOrderOfServiceById' => Response::HTTP_NOT_FOUND,
        'updateOrderOfService' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteOrderOfService' => Response::HTTP_NOT_FOUND,
    ];
}
