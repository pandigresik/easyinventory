<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Inventory\Product;
use App\Models\Inventory\StorageLocation;
use App\Repositories\Inventory\StockOutMoveRepository;

class StockOutMoveController extends StockMoveController
{
    protected $baseView = 'inventory.stock_out_moves';
    protected $baseRoute = 'inventory.stockOutMoves';
    protected $excludeProductId = [];
    protected $excludeStorageLocationId = [];
    public function __construct()
    {
        $this->repository = StockOutMoveRepository::class;
    }

    /**
     * Show the form for editing the specified StockMove.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockMove = $this->getRepositoryObj()->find($id);

        if (empty($stockMove)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockMoves.singular')]));

            return redirect(route($this->baseRoute.'.index'));
        }
        $stockMoveLines = $stockMove->stockMoveLines;
        $this->excludeStorageLocationId = $stockMoveLines->pluck('storage_location_id');
        $this->excludeProductId = $stockMoveLines->pluck('product_id');
        $optionItems = $this->getOptionItems();                        
        return view($this->baseView.'.edit')->with(['stockMove' => $stockMove, 'lines' => $stockMoveLines])->with($optionItems);
    }

    protected function getOptionItems(){
        $optionItems = parent::getOptionItems();
        $excludeProductId = $this->excludeProductId;
        $optionItems['productItems'] = ['' => __('crud.option.product_placeholder')] +  Product::whereHas('stockProducts', function($q) use ($excludeProductId) {            
            return $q->where('quantity','>',0)->orWhere(function($r) use ($excludeProductId) {
                return $r->whereIn('id', $excludeProductId);
            });
        })->pluck('name', 'id')->toArray();
        $mustHasStock = true;
        $excludeStorageLocationId = $this->excludeStorageLocationId;
        $optionItems['locationItems'] = ['' => __('crud.option.product_placeholder')] +  (new StorageLocation)->pluckGroupWarehouse($mustHasStock, $excludeStorageLocationId);
        return $optionItems;        
    }
}
