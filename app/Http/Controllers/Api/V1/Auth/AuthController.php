<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Resources\Auth\AuthResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
          new Middleware('auth:sanctum' ,only: ['logout']),
        ];
    }


    /**
     * Summary of login
     * Authenticate user dengan LoginRequest
     * Jika berhasil, akan mengembalikan token dan data user
     * Jika gagal, akan mengembalikan error yang sesuai
     * Menggunakan Laravel Sanctum untuk token authentication
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return AuthResource
     */
     public function login(LoginRequest $request)
     {


        $request->authenticate();

        $user = $request->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 422);
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return new AuthResource([
            'user' => $user,
            'token' => $token,
            'status' => 'success',
            'message' => 'Login successful',
        ]);
    }

    /**
     * Summary of logout
     * Logout user dengan menghapus token yang ada
     * Menggunakan Laravel Sanctum untuk token authentication
     * Jika berhasil, akan mengembalikan pesan sukses
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
     public function logout(Request $request)
    {

        $user = $request->user();

        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout successful',
        ]);
    }
}

