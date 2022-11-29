<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();    
});

Route::group(['prefix' => 'inventory'], function () {
    Route::resource('uom_types', App\Http\Controllers\API\Inventory\UomTypeAPIController::class);
    Route::resource('uom_categories', App\Http\Controllers\API\Inventory\UomCategoryAPIController::class);
    Route::resource('uoms', App\Http\Controllers\API\Inventory\UomAPIController::class);
    Route::resource('product_categories', App\Http\Controllers\API\Inventory\ProductCategoryAPIController::class);
    Route::resource('products', App\Http\Controllers\API\Inventory\ProductAPIController::class);
    Route::resource('stock_products', App\Http\Controllers\API\Inventory\StockProductAPIController::class);
    Route::resource('warehouses', App\Http\Controllers\API\Inventory\WarehouseAPIController::class);
    Route::resource('storage_locations', App\Http\Controllers\API\Inventory\StorageLocationAPIController::class);    
    Route::resource('stock_moves', App\Http\Controllers\API\Inventory\StockMoveAPIController::class);
    Route::resource('stock_move_lines', App\Http\Controllers\API\Inventory\StockMoveLineAPIController::class);
    Route::resource('stock_adjustments', App\Http\Controllers\API\Inventory\StockAdjustmentAPIController::class);
    Route::resource('stock_adjustment_lines', App\Http\Controllers\API\Inventory\StockAdjustmentLineAPIController::class);
});


