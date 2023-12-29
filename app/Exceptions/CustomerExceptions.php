<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;

class CustomerExceptions extends OrchestratorException
{
    protected $errorStatuses = [
        'getAllCustomers' => Response::HTTP_NOT_FOUND,
        'saveCustomer' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getCustomerById' => Response::HTTP_NOT_FOUND,
        'updateCustomer' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteCustomer' => Response::HTTP_NOT_FOUND,
    ];
}
