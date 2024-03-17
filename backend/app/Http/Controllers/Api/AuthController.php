<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $authLoginRequest)
    {
        try {
            $user = User::where('email', $authLoginRequest->get('email'))->first();
            if (!$user) {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Invalid credentials',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            if (!Hash::check($authLoginRequest->get('password'), $user->password)) {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Invalid credentials',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
            return new JsonResponse([
                'success' => true,
                'access_token' => $token,
                'message' => 'Successfully login'
            ]);
        } catch (Throwable $exception) {
            return new JsonResponse([
                'success' => false,
                'message' => $exception->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return new JsonResponse([
            'message' => 'logged out'
        ]);
    }

    public function me(Request $request)
    {
        return $request->user();
    }
}
