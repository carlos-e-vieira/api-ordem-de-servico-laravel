<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class OrchestratorException extends Exception
{
    protected $errorStatuses = [];

    public function render($request)
    {
        $statusCode = $this->getStatusCode($this->getMessage());

        return response()->json(['success' => false, 'error' => $this->getMessage()], $statusCode);
    }

    public function getStatusCode(string $key): int
    {
        return $this->errorStatuses[$key] ?? Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
