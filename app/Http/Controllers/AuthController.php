<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\Translator;
use App\Http\Requests\AuthFormRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AuthFormRequest $authFormRequest): JsonResponse
    {
        $credentials = $authFormRequest->only('email', 'password');

        $token = $this->authService->getToken($credentials);

        return response()->json(['success' => true, 'token' => $token], Response::HTTP_OK);
    }

    public function logout(): JsonResponse
    {
        auth('api')->logout();

        return response()->json(['success' => true, 'message' => Translator::LOGOUT_SUCCESS]);
    }

    public function refresh(): JsonResponse
    {
        $token = auth('api')->refresh();

        return response()->json(['success' => true, 'token' => $token]);
    }

    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }
}
