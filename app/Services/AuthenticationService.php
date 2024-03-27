<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthenticationService
{
    public function Login(array $authenticationData): JsonResponse
    {
        if(!auth()->attempt($authenticationData)){
            return response()->json([
                'message' => 'Credenciales inválidas.'
            ], Response::HTTP_OK);
        }
        
        $token = auth()->user()->createToken('authenticationToken');

        return response()->json([
            'message' => 'Inicio de sesión correcto.',
            'token' => $token->plainTextToken
        ], Response::HTTP_OK);
    }

    public function Logout(User $user): JsonResponse
    {
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Sesión cerrada, tokens eliminados.'
        ], Response::HTTP_OK);
    }
}