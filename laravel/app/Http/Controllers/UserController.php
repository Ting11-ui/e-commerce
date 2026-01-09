<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users
     * Only users with 'users.manage' permission can access
     */
    public function index(Request $request)
    {
        // Check if current user has 'users.manage' permission
        if (!$request->user()->can('users.manage')) {
            return response()->json([
                'message' => 'Unauthorized: You need users.manage permission'
            ], 403);
        }

        // Load users with their roles
        $users = User::with('roles')->get();

        return response()->json($users);
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        if (!$request->user()->can('users.manage')) {
            return response()->json([
                'message' => 'Unauthorized: You need users.manage permission'
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'sometimes|in:Customer,Staff,Manager',
        ]);

        // Hash the password before storing
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        // Assign role if provided
        if (isset($validated['role'])) {
            $user->assignRole($validated['role']);
        }

        // Load the user with roles for the response
        $user->load('roles');

        return response()->json($user, 201);
    }

    /**
     * Display the specified user
     */
    public function show(Request $request, User $user)
    {
        if (!$request->user()->can('users.manage')) {
            return response()->json([
                'message' => 'Unauthorized: You need users.manage permission'
            ], 403);
        }

        $user->load('roles');
        return response()->json($user);
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        if (!$request->user()->can('users.manage')) {
            return response()->json([
                'message' => 'Unauthorized: You need users.manage permission'
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:8',
            'role' => 'sometimes|in:Customer,Staff,Manager',
        ]);

        // Hash password if it's being updated
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Update role if provided
        if (isset($validated['role'])) {
            $user->syncRoles([$validated['role']]);
            unset($validated['role']);
        }

        $user->update($validated);
        $user->load('roles');

        return response()->json($user);
    }

    /**
     * Remove the specified user
     */
    public function destroy(Request $request, User $user)
    {
        if (!$request->user()->can('users.manage')) {
            return response()->json([
                'message' => 'Unauthorized: You need users.manage permission'
            ], 403);
        }

        // Prevent user from deleting themselves
        if ($user->id === $request->user()->id) {
            return response()->json([
                'message' => 'You cannot delete your own account'
            ], 400);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
