<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(UserFormRequest $userFormRequest): JsonResponse
    {
        $response = $this->userService->getAllUsers($userFormRequest->toArray());

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function store(UserFormRequest $userFormRequest): JsonResponse
    {
        $requestData = $userFormRequest->only('name', 'email', 'password');

        $response = $this->userService->saveUser($requestData);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_CREATED);
    }

    public function show(int $id)
    {

    }

    public function update(UserFormRequest $userFormRequest, int $id)
    {

    }

    public function destroy(int $id)
    {

    }
}
