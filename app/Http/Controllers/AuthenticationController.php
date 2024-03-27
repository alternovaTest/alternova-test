<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use App\Services\AuthenticationService;
use Illuminate\Http\JsonResponse;

class AuthenticationController extends Controller
{
    public function __construct(
        private AuthenticationService $authenticationService,
    ) {}

    public function Login(AuthenticationRequest $authenticationRequest): JsonResponse
    {
        return $this->authenticationService->Login($authenticationRequest->validated());
    }

    public function Logout(): JsonResponse
    {
        return $this->authenticationService->Logout(auth()->user());
    }
}
