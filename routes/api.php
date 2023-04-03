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

Route::post('login', [App\Http\Controllers\API\Auth\ApiLoginController::class, 'requestToken']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return ['data' => $request->user()];
});

Route::group(['prefix' => 'inventory', 'middleware' => 'auth:sanctum'], function () {    
    Route::resource('uom_categories', Inventory\UomCategoryAPIController::class);
    Route::resource('uoms', Inventory\UomAPIController::class);
    Route::resource('product_categories', Inventory\ProductCategoryAPIController::class);
    Route::resource('products', Inventory\ProductAPIController::class);
    Route::resource('stock_products', Inventory\StockProductAPIController::class);
    Route::resource('warehouses', Inventory\WarehouseAPIController::class);
    Route::resource('warehouseUsers', Inventory\WarehouseUserAPIController::class)->only(['index']);    
    Route::resource('storage_locations', Inventory\StorageLocationAPIController::class);    
    Route::resource('stock_moves', Inventory\StockMoveAPIController::class);
    Route::get('transfer_in/getListTransferProduct', [App\Http\Controllers\API\Inventory\TransferInWHAPIController::class, 'getListTransferProduct']);
    Route::resource('transfer_in', Inventory\TransferInWHAPIController::class);    
    Route::resource('stock_move_lines', Inventory\StockMoveLineAPIController::class);
    Route::resource('stock_adjustments', Inventory\StockAdjustmentAPIController::class);
    Route::resource('stock_adjustment_lines', Inventory\StockAdjustmentLineAPIController::class);
});


