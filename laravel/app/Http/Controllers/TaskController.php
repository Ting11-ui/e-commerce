<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Apply auth middleware to all methods
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of tasks
     * Manager sees all tasks, Employee sees only their own
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('Manager')) {
            // Manager can see all tasks
            $tasks = Task::with(['category', 'assignedTo'])->get();
        } else {
            // Employee sees only their assigned tasks
            $tasks = Task::with(['category', 'assignedTo'])
                ->where('assigned_to', $user->id)
                ->get();
        }

        return response()->json($tasks);
    }

    /**
     * Store a newly created task
     * Only Manager can create tasks
     */
    public function store(Request $request)
    {
        if (!$request->user()->can('task.create')) {
            return response()->json([
                'message' => 'Unauthorized: You need task.create permission'
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
            'status' => 'sometimes|in:pending,in_progress,completed',
            'priority' => 'sometimes|in:low,medium,high',
        ]);

        $task = Task::create($validated);
        $task->load(['category', 'assignedTo']);

        return response()->json($task, 201);
    }

    /**
     * Display the specified task
     * Manager can see any task, Employee can only see their own
     */
    public function show(Request $request, Task $task)
    {
        $user = $request->user();

        // If employee, check if task is assigned to them
        if (!$user->hasRole('Manager') && $task->assigned_to !== $user->id) {
            return response()->json([
                'message' => 'Unauthorized: You can only view your own tasks'
            ], 403);
        }

        $task->load(['category', 'assignedTo']);
        return response()->json($task);
    }

    /**
     * Update the specified task
     * Manager can update any task
     * Employee can update status of their own tasks
     */
    public function update(Request $request, Task $task)
    {
        $user = $request->user();

        if ($user->hasRole('Manager')) {
            // Manager can update everything
            $validated = $request->validate([
                'title' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'category_id' => 'sometimes|exists:categories,id',
                'assigned_to' => 'sometimes|exists:users,id',
                'due_date' => 'nullable|date',
                'status' => 'sometimes|in:pending,in_progress,completed',
                'priority' => 'sometimes|in:low,medium,high',
            ]);
        } else {
            // Employee can only update status of their own tasks
            if ($task->assigned_to !== $user->id) {
                return response()->json([
                    'message' => 'Unauthorized: You can only update your own tasks'
                ], 403);
            }

            $validated = $request->validate([
                'status' => 'required|in:pending,in_progress,completed',
            ]);
        }

        $task->update($validated);
        $task->load(['category', 'assignedTo']);

        return response()->json($task);
    }

    /**
     * Remove the specified task
     * Only Manager can delete tasks
     */
    public function destroy(Request $request, Task $task)
    {
        if (!$request->user()->can('task.delete')) {
            return response()->json([
                'message' => 'Unauthorized: You need task.delete permission'
            ], 403);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
