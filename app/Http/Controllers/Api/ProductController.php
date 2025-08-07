<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $products = Product::where('is_active', true)
                ->orderBy('name')
                ->get();

            $formattedProducts = $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'sku' => $product->sku,
                    'name' => $product->name,
                    'description' => $product->description,
                    'category' => $product->category,
                    'type' => $product->type,
                    'color' => $product->color,
                    'width' => $product->width,
                    'length' => $product->length,
                    'price' => $product->price,
                    'currency' => $product->currency,
                    'image_url' => $product->image_url,
                    'specifications' => $product->specifications,
                    'features' => $product->features,
                    'applications' => $product->applications,
                    'is_featured' => $product->is_featured,
                    'stock_quantity' => $product->stock_quantity
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedProducts,
                'message' => 'Products retrieved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified product.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $product = Product::where('is_active', true)
                ->where(function($query) use ($id) {
                    $query->where('id', $id)
                          ->orWhere('sku', $id);
                })
                ->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'error' => 'Product not found',
                    'message' => 'The requested product could not be found'
                ], 404);
            }

            $formattedProduct = [
                'id' => $product->id,
                'sku' => $product->sku,
                'name' => $product->name,
                'description' => $product->description,
                'category' => $product->category,
                'type' => $product->type,
                'color' => $product->color,
                'width' => $product->width,
                'length' => $product->length,
                'price' => $product->price,
                'currency' => $product->currency,
                'image_url' => $product->image_url,
                'specifications' => $product->specifications,
                'features' => $product->features,
                'applications' => $product->applications,
                'is_featured' => $product->is_featured,
                'stock_quantity' => $product->stock_quantity
            ];

            return response()->json([
                'success' => true,
                'data' => $formattedProduct,
                'message' => 'Product retrieved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search products by name, description, or SKU.
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');
        
        if (!$query) {
            return response()->json([
                'success' => false,
                'error' => 'Search query required',
                'message' => 'Please provide a search query parameter "q"'
            ], 400);
        }

        try {
            $products = Product::where('is_active', true)
                ->where(function($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%")
                      ->orWhere('sku', 'LIKE', "%{$query}%")
                      ->orWhere('category', 'LIKE', "%{$query}%");
                })
                ->orderBy('name')
                ->limit(20)
                ->get();

            $formattedProducts = $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'sku' => $product->sku,
                    'name' => $product->name,
                    'description' => $product->description,
                    'category' => $product->category,
                    'type' => $product->type,
                    'color' => $product->color,
                    'width' => $product->width,
                    'price' => $product->price,
                    'currency' => $product->currency,
                    'image_url' => $product->image_url,
                    'is_featured' => $product->is_featured
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedProducts,
                'message' => 'Search completed successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get product categories.
     */
    public function categories(): JsonResponse
    {
        try {
            $categories = Product::where('is_active', true)
                ->select('category')
                ->distinct()
                ->orderBy('category')
                ->pluck('category');

            $categoryData = $categories->map(function ($category) {
                return [
                    'name' => $category,
                    'product_count' => Product::where('category', $category)
                        ->where('is_active', true)
                        ->count()
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $categoryData,
                'message' => 'Categories retrieved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get products by category.
     */
    public function byCategory(string $categoryId): JsonResponse
    {
        try {
            $products = Product::where('category', $categoryId)
                ->where('is_active', true)
                ->orderBy('name')
                ->get();

            if ($products->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Category not found',
                    'message' => 'No products found for the specified category'
                ], 404);
            }

            $formattedProducts = $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'sku' => $product->sku,
                    'name' => $product->name,
                    'description' => $product->description,
                    'category' => $product->category,
                    'type' => $product->type,
                    'color' => $product->color,
                    'width' => $product->width,
                    'price' => $product->price,
                    'currency' => $product->currency,
                    'image_url' => $product->image_url,
                    'is_featured' => $product->is_featured
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedProducts,
                'message' => 'Products retrieved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
