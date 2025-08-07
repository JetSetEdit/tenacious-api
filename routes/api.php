<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes (no authentication required)
Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'message' => 'Tenacious Tapes API is running',
        'version' => '1.0.0',
        'timestamp' => now()->toISOString()
    ]);
});

// Authentication routes
Route::prefix('auth')->group(function () {
    Route::get('/validate', [AuthController::class, 'validate']);
    Route::get('/usage', [AuthController::class, 'usage'])->middleware('auth:sanctum');
    Route::get('/endpoints', [AuthController::class, 'endpoints'])->middleware('auth:sanctum');
});

// Protected routes (require API key via Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    
    // Product routes
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/search', [ProductController::class, 'search']);
        Route::get('/categories', [ProductController::class, 'categories']);
        Route::get('/category/{categoryId}', [ProductController::class, 'byCategory']);
        Route::get('/{id}', [ProductController::class, 'show']);
    });

    // Brand routes
    Route::prefix('brand')->group(function () {
        Route::get('/overview', [BrandController::class, 'overview']);
        Route::get('/company', [BrandController::class, 'company']);
        Route::get('/categories', [BrandController::class, 'categories']);
        Route::get('/featured', [BrandController::class, 'featured']);
    });

});

// Fallback route for undefined API endpoints
Route::fallback(function () {
    return response()->json([
        'success' => false,
        'error' => 'Endpoint not found',
        'message' => 'The requested API endpoint does not exist',
        'available_endpoints' => [
            'GET /api/health' => 'Check API status',
            'GET /api/auth/validate' => 'Validate API key',
            'GET /api/products' => 'List products (requires auth)',
            'GET /api/brand/overview' => 'Get brand overview (requires auth)'
        ]
    ], 404);
}); 