<?php

use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tes', [App\Http\Controllers\HomeController::class, 'tes']);
Route::get('password.change', [\App\Http\Controllers\Auth\ChangePasswordController::class, 'showResetForm'])->name('password.change');
Route::post('password.change', [\App\Http\Controllers\Auth\ChangePasswordController::class, 'reset'])->name('password.change');

//Route::group(['middleware' => ['auth','role:administrator']],function (){
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'base'], function () {
        Route::resource('import', Base\ImportController::class, ['as' => 'base']);
        Route::resource('export', Base\ExportController::class, ['as' => 'base']);
        Route::resource('roles', Base\RoleController::class, ["as" => 'base', 'middleware' => ['easyauth']]);
        Route::resource('permissions', Base\PermissionController::class, ["as" => 'base', 'middleware' => ['easyauth']]);
        Route::resource('users', Base\UserController::class, ["as" => 'base', 'middleware' => ['easyauth']]);
        Route::resource('menus', Base\MenusController::class, ["as" => 'base', 'middleware' => ['easyauth']]);
    });

    Route::group(['prefix' => 'inventory'], function(){        
        Route::resource('uomCategories', Inventory\UomCategoryController::class, ["as" => 'inventory'])->middleware(['easyauth']);
        Route::resource('uoms', Inventory\UomController::class, ["as" => 'inventory'])->middleware(['easyauth']);
        Route::resource('productCategories', Inventory\ProductCategoryController::class, ["as" => 'inventory'])->middleware(['easyauth']);
        Route::resource('products', Inventory\ProductController::class, ["as" => 'inventory'])->middleware(['easyauth']);
        Route::resource('stockProducts', Inventory\StockProductController::class, ["as" => 'inventory'])->middleware(['easyauth']);
        Route::resource('warehouses', Inventory\WarehouseController::class, ["as" => 'inventory'])->middleware(['easyauth']);
        Route::resource('storageLocations', Inventory\StorageLocationController::class, ["as" => 'inventory'])->middleware(['easyauth']);        
        // Route::resource('stockMoves', Inventory\StockMoveController::class, ["as" => 'inventory']);
        Route::resource('stockInMoves', Inventory\StockInMoveController::class, ["as" => 'inventory']);
        Route::resource('stockOutMoves', Inventory\StockOutMoveController::class, ["as" => 'inventory']);
        Route::get('transferInWH/getListTransferProduct',[App\Http\Controllers\Inventory\TransferInWHController::class, 'getListTransferProduct'])->name('inventory.transferInWH.list-product');
        Route::resource('transferInWH', Inventory\TransferInWHController::class, ["as" => 'inventory']);        
        Route::resource('transferOutWH', Inventory\TransferOutWHController::class, ["as" => 'inventory']);
        
        // Route::resource('stockMoveLines', Inventory\StockMoveLineController::class, ["as" => 'inventory'])->only(['index']);
        Route::get('stockMoveLines/{productId}/{storageLocationId}', [App\Http\Controllers\Inventory\StockMoveLineController::class, 'index'])->name('inventory.stockMoveLines.product');
        Route::resource('stockAdjustments', Inventory\StockAdjustmentController::class, ["as" => 'inventory'])->middleware(['easyauth']);
        Route::resource('stockAdjustmentLines', Inventory\StockAdjustmentLineController::class, ["as" => 'inventory']);

        Route::get('qrcode', [\App\Http\Controllers\Inventory\QRController::class, 'index'])->name('inventory.qrcode');
    });
    Route::get('/selectAjax', [App\Http\Controllers\SelectAjaxController::class, 'index'])->name('selectAjax');
    Route::get('/storage', 'StorageController');
//    Route::get('/events', [App\Http\Controllers\EventsController::class, 'index'])->name('events.index');
});

// builder generator
// Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');
// Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');
// Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');
// Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');
// Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback'); 
// Route::post(
//     'generator_builder/generate-from-file',
//     '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
// )->name('io_generator_builder_generate_from_file');

Route::group(['prefix' => 'artisan'], function () {
    Route::get('clear_cache', function () {
        Artisan::call('cache:clear');
    });
});
