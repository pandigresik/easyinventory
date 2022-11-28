<?php

namespace App\Http\Controllers\Inventory;

use App\Repositories\Inventory\StockInMoveRepository;

class StockInMoveController extends StockMoveController
{
    protected $baseView = 'inventory.stock_moves';
    protected $baseRoute = 'inventory.stockInMoves';

    public function __construct()
    {
        $this->repository = StockInMoveRepository::class;
    }
}
