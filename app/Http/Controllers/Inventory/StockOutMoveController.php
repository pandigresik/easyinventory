<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Inventory\Product;
use App\Models\Inventory\StorageLocation;
use App\Repositories\Inventory\StockOutMoveRepository;

class StockOutMoveController extends StockMoveController
{
    protected $baseView = 'inventory.stock_out_moves';
    protected $baseRoute = 'inventory.stockOutMoves';

    public function __construct()
    {
        $this->repository = StockOutMoveRepository::class;
    }

    protected function getOptionItems(){
        $optionItems = parent::getOptionItems();
        $optionItems['productItems'] = ['' => __('crud.option.product_placeholder')] +  Product::whereHas('stockProducts', function($q){
            return $q->where('quantity','>',0);
        })->pluck('name', 'id')->toArray();
        $optionItems['locationItems'] = ['' => __('crud.option.product_placeholder')] +  StorageLocation::whereHas('stockProducts', function($q){
            return $q->where('quantity','>',0);
        })->whereIsLeaf()->pluck('name', 'id')->toArray();
        return $optionItems;        
    }
}
