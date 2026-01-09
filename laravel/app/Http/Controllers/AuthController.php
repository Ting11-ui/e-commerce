<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('auth_token')->accessToken; // Changed to accessToken

                return response()->json([
                    'message' => 'Login successful',
                    'user' => $user->load('roles.permissions'),
                    'token' => $token,
                    'roles' => $user->roles->pluck('name'),
                    'permissions' => $user->roles->flatMap->permissions->pluck('name')->unique()
                ], 200);
            }

            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me(Request $request)
    {
        $user = $request->user()->load('roles.permissions');
        return response()->json([
            'user' => $user,
            'roles' => $user->roles->pluck('name'),
            'permissions' => $user->roles->flatMap->permissions->pluck('name')->unique()
        ]);
    }
}
