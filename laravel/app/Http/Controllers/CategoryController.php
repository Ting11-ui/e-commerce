<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories
     * Anyone authenticated can view categories
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created category
     * Only Manager can create categories
     */
    public function store(Request $request)
    {
        // This checks if user has 'category.create' permission (Manager only)
        abort_unless(auth()->user()->can('category.create'), 403, 'Unauthorized: You need category.create permission');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        $category = Category::create($validated);
        
        return response()->json($category, 201);
    }

    /**
     * Update the specified category
     * Only Manager can update categories
     */
    public function update(Request $request, Category $category)
    {
        // This checks if user has 'category.update' permission (Manager only)
        abort_unless(auth()->user()->can('category.update'), 403, 'Unauthorized: You need category.update permission');
        
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        $category->update($validated);
        
        return response()->json($category);
    }

    /**
     * Remove the specified category
     * Only Manager can delete categories
     */
    public function destroy(Category $category)
    {
        // This checks if user has 'category.delete' permission (Manager only)
        abort_unless(auth()->user()->can('category.delete'), 403, 'Unauthorized: You need category.delete permission');
        
        $category->delete();
        
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
