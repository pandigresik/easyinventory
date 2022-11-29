<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\StockMoveLineDataTable;
use App\Http\Requests\Inventory\CreateStockMoveLineRequest;
use App\Http\Requests\Inventory\UpdateStockMoveLineRequest;
use App\Repositories\Inventory\StockMoveLineRepository;
use App\Repositories\Inventory\ProductRepository;
use App\Repositories\Inventory\StockMoveRepository;
use App\Repositories\Inventory\StorageLocationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Inventory\Product;
use App\Models\Inventory\StorageLocation;
use Response;
use Exception;

class StockMoveLineController extends AppBaseController
{
    /** @var  StockMoveLineRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = StockMoveLineRepository::class;
    }

    /**
     * Display a listing of the StockMoveLine.
     *
     * @param StockMoveLineDataTable $stockMoveLineDataTable
     * @return Response
     */
    public function index(int $productId, int $storageLocationId, StockMoveLineDataTable $stockMoveLineDataTable)
    {
        $product = Product::find($productId);
        $storageLocation = StorageLocation::find($storageLocationId);
        $title = 'History Product '.$product->name. ' ( '.$storageLocation->name.' )';
        return $stockMoveLineDataTable->setStorageLocationId($storageLocationId)->setProductId($productId)->render('inventory.stock_move_lines.index', ['title' => $title]);
    }
}
