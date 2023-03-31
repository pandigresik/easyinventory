<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Inventory\Product;
use App\Models\Inventory\StockMove;
use App\Models\Inventory\StorageLocation;
use App\Repositories\Inventory\TransferOutWHRepository;
use App\Repositories\Inventory\WarehouseRepository;

class TransferOutWHController extends StockMoveController
{
    protected $baseView = 'inventory.transfer_out_wh';
    protected $baseRoute = 'inventory.transferOutWHController';
    protected $excludeProductId = [];
    protected $excludeStorageLocationId = [];

    public function __construct()
    {
        $this->repository = TransferOutWHRepository::class;
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
        $destination = StockMove::where(['references' => $stockMove->number, 'stock_move_type' => 'TMP_TR_OUT'])->first();
        $stockMove->warehouse_destination_id = $destination->warehouse_id ?? NULL;
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
        $warehouse = new WarehouseRepository();
        $optionItems = parent::getOptionItems();
        $excludeProductId = $this->excludeProductId;
        $optionItems['productItems'] = ['' => __('crud.option.product_placeholder')] +  Product::whereHas('stockProducts', function($q) use($excludeProductId) {
            return $q->where('quantity','>',0)->orWhere(function($r) use ($excludeProductId) {
                return $r->whereIn('id', $excludeProductId);
            });
        })->pluck('name', 'id')->toArray();
        $mustHasStock = true;
        $excludeStorageLocationId = $this->excludeStorageLocationId;
        $optionItems['locationItems'] = ['' => __('crud.option.product_placeholder')] +  (new StorageLocation)->pluckGroupWarehouse($mustHasStock, $excludeStorageLocationId);
        
        $optionItems['warehouseDestinationItems'] = ['' => __('crud.option.warehouse_placeholder')] + $warehouse->pluck();
        return $optionItems;        
    }
}
