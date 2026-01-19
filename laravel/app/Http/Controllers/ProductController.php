<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     * Anyone authenticated can view products
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created product
     * Staff and Manager can create products
     */
    public function store(Request $request)
    {
        // This is the permission check - Staff and Manager have 'products.create'
        if (!$request->user()->can('products.create')) {
            return response()->json([
                'message' => 'Unauthorized: You need products.create permission'
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    /**
     * Display the specified product
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified product
     * Only Manager can update products
     */
    public function update(Request $request, Product $product)
    {
        // This checks if user has 'products.update' permission (Manager only)
        if (!$request->user()->can('products.update')) {
            return response()->json([
                'message' => 'Unauthorized: You need products.update permission'
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    /**
     * Remove the specified product
     * Only Manager can delete products
     */
    public function destroy(Request $request, Product $product)
    {
        // This checks if user has 'products.delete' permission (Manager only)
        if (!$request->user()->can('products.delete')) {
            return response()->json([
                'message' => 'Unauthorized: You need products.delete permission'
            ], 403);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
