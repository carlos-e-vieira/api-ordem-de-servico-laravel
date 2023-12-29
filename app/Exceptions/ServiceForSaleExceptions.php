<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;

class ServiceForSaleExceptions extends OrchestratorException
{
    protected $errorStatuses = [
        'getAllServicesForSale' => Response::HTTP_NOT_FOUND,
        'saveServiceForSale' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getServiceForSaleById' => Response::HTTP_NOT_FOUND,
        'updateServiceForSale' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteServiceForSale' => Response::HTTP_NOT_FOUND,
    ];
}
