<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = Auth::user();
    $token = $user->createToken('mobile')->plainTextToken; // Changed from accessToken to plainTextToken

    return response()->json([
        'token' => $token,
        'user' => $user->load('roles.permissions'),
        'roles' => $user->roles->pluck('name'),
        'permissions' => $user->roles->flatMap->permissions->pluck('name')->unique()
    ]);
});

// Protected routes - require authentication via Sanctum
Route::middleware('auth:sanctum')->group(function () { // Changed from auth:api to auth:sanctum

    // Get current user info
    Route::get('/me', function (Request $request) {
        $user = $request->user()->load('roles.permissions');
        return response()->json([
            'user' => $user,
            'roles' => $user->roles->pluck('name'),
            'permissions' => $user->roles->flatMap->permissions->pluck('name')->unique()
        ]);
    });

    // Logout
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete(); // Changed from token()->revoke()
        return response()->json(['message' => 'Successfully logged out']);
    });

    // Task routes (with policy protection)
    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index']);
        Route::post('/', [TaskController::class, 'store']);
        Route::get('/{task}', [TaskController::class, 'show']);
        Route::put('/{task}', [TaskController::class, 'update']);
        Route::patch('/{task}/status', [TaskController::class, 'updateStatus']);
        Route::delete('/{task}', [TaskController::class, 'destroy']);
    });

    // Product routes (with permission protection)
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{product}', [ProductController::class, 'update']);
        Route::delete('/{product}', [ProductController::class, 'destroy']);
    });

    // Category routes (with permission protection)
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    });
});
