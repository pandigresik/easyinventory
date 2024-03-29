<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Inventory\Product;
use App\Models\Inventory\StockMoveLine;
use App\Models\Inventory\StorageLocation;
use App\Repositories\Inventory\TransferInWHRepository;
use App\Repositories\Inventory\WarehouseRepository;

class TransferInWHController extends StockMoveController
{
    /** @var  TransferInWHRepository */
    protected $repository;
    protected $baseView = 'inventory.transfer_in_wh';
    protected $baseRoute = 'inventory.transferInWH';

    public function __construct()
    {
        $this->repository = TransferInWHRepository::class;
    }
    /** get list product send to currentWarehouse from originWarehouse */
    public function getListTransferProduct(){
        $currentWarehouse = request()->get('currentWarehouse');
        $originWarehouse = request()->get('originWarehouse');
        $detail = (new StockMoveLine())->listTransferInWH($currentWarehouse, $originWarehouse);
        return $this->sendResponse($detail, 'success');
    }

    protected function getOptionItems()
    {        
        $warehouse = new WarehouseRepository();
        $optionItems = parent::getOptionItems();
        $optionItems['productItems'] = ['' => __('crud.option.product_placeholder')] +  Product::whereHas('stockProducts', function ($q) {
            return $q->where('quantity', '>', 0);
        })->pluck('name', 'id')->toArray();
        
        $optionItems['locationItems'] = ['' => __('crud.option.product_placeholder')] + (new StorageLocation)->pluckGroupWarehouse();
        
        $optionItems['warehouseOriginItems'] = ['' => __('crud.option.warehouse_placeholder')] + $warehouse->pluck();
        return $optionItems;
    }
}
