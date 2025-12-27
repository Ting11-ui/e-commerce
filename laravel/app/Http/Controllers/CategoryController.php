<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'message' => 'Getting list of categories',
            'data' => $categories
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = Category::create($validated);
        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'message' => 'Getting category details',
            'data' => $category
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255'
        ]);

        $category->update($validated);
        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category
        ], 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully'
        ], 200);
    }

    public function getProducts($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $products = $category->products;
        return response()->json([
            'message' => 'Getting products for category',
            'data' => $products
        ], 200);
    }
}
