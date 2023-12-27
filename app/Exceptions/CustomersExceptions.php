<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;

class CustomersExceptions extends OrchestratorException
{
    protected $errorStatuses = [
        'getAllCustomers' => Response::HTTP_NOT_FOUND,
        'savCustomerr' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getCustomerById' => Response::HTTP_NOT_FOUND,
        'updateCustomer' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteCustomer' => Response::HTTP_NOT_FOUND,
    ];
}
