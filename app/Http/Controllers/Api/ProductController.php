<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of products from Jiwa.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            // Connect to Jiwa database
            $products = DB::connection('jiwa')
                ->table('InventoryItem')
                ->select([
                    'InventoryItemID',
                    'ItemCode',
                    'ItemDescription',
                    'CategoryID',
                    'UnitOfMeasure',
                    'IsActive'
                ])
                ->where('IsActive', 1)
                ->limit(50)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $products,
                'message' => 'Products retrieved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Database connection failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified product from Jiwa.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $product = DB::connection('jiwa')
                ->table('InventoryItem')
                ->select([
                    'InventoryItemID',
                    'ItemCode',
                    'ItemDescription',
                    'CategoryID',
                    'UnitOfMeasure',
                    'IsActive'
                ])
                ->where('InventoryItemID', $id)
                ->orWhere('ItemCode', $id)
                ->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'error' => 'Product not found',
                    'message' => 'The requested product could not be found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $product,
                'message' => 'Product retrieved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Database connection failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search products by description or code.
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
            $products = DB::connection('jiwa')
                ->table('InventoryItem')
                ->select([
                    'InventoryItemID',
                    'ItemCode',
                    'ItemDescription',
                    'CategoryID',
                    'UnitOfMeasure',
                    'IsActive'
                ])
                ->where('IsActive', 1)
                ->where(function($q) use ($query) {
                    $q->where('ItemDescription', 'LIKE', "%{$query}%")
                      ->orWhere('ItemCode', 'LIKE', "%{$query}%");
                })
                ->limit(20)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $products,
                'message' => 'Search completed successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Database connection failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get product categories from Jiwa.
     */
    public function categories(): JsonResponse
    {
        try {
            $categories = DB::connection('jiwa')
                ->table('Category')
                ->select([
                    'CategoryID',
                    'CategoryDescription',
                    'IsActive'
                ])
                ->where('IsActive', 1)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $categories,
                'message' => 'Categories retrieved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Database connection failed',
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
            $products = DB::connection('jiwa')
                ->table('InventoryItem')
                ->select([
                    'InventoryItemID',
                    'ItemCode',
                    'ItemDescription',
                    'CategoryID',
                    'UnitOfMeasure',
                    'IsActive'
                ])
                ->where('CategoryID', $categoryId)
                ->where('IsActive', 1)
                ->limit(50)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $products,
                'message' => 'Products retrieved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Database connection failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
