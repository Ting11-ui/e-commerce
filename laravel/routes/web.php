<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Authentication routes (simplified for demo)
Route::post('/login', function (Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return response()->json(['message' => 'Logged in successfully']);
    }
    
    return response()->json(['message' => 'Invalid credentials'], 401);
});

Route::post('/logout', function (Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return response()->json(['message' => 'Logged out successfully']);
});

// Protected routes - require authentication
Route::middleware('auth')->group(function () {
    
    // User management (Admin only - requires 'users.manage')
    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index']);
        Route::post('/', [App\Http\Controllers\UserController::class, 'store']);
        Route::put('/{user}', [App\Http\Controllers\UserController::class, 'update']);
        Route::delete('/{user}', [App\Http\Controllers\UserController::class, 'destroy']);
    });

    // Product management
    Route::prefix('products')->group(function () {
        Route::get('/', [App\Http\Controllers\ProductController::class, 'index']); // All
        Route::post('/', [App\Http\Controllers\ProductController::class, 'store']); // Staff + Manager
        Route::put('/{product}', [App\Http\Controllers\ProductController::class, 'update']); // Manager only
        Route::delete('/{product}', [App\Http\Controllers\ProductController::class, 'destroy']); // Manager only
    });

    // Category management (Manager only)
    Route::prefix('categories')->group(function () {
        Route::get('/', [App\Http\Controllers\CategoryController::class, 'index']); // All
        Route::post('/', [App\Http\Controllers\CategoryController::class, 'store']); // Manager only
        Route::put('/{category}', [App\Http\Controllers\CategoryController::class, 'update']); // Manager only
        Route::delete('/{category}', [App\Http\Controllers\CategoryController::class, 'destroy']); // Manager only
    });

    // Test endpoint to check current user's permissions
    Route::get('/me', function () {
        $user = auth()->user();
        return response()->json([
            'user' => $user->name,
            'email' => $user->email,
            'roles' => $user->roles->pluck('name'),
            'permissions' => $user->roles->flatMap->permissions->pluck('name')->unique(),
        ]);
    });
});
