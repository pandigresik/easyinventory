<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\StockAdjustmentDataTable;
use App\Http\Requests\Inventory;
use App\Http\Requests\Inventory\CreateStockAdjustmentRequest;
use App\Http\Requests\Inventory\UpdateStockAdjustmentRequest;
use App\Repositories\Inventory\StockAdjustmentRepository;

use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Inventory\StockAdjustmentLine;
use App\Models\Inventory\StockProduct;
use App\Models\Inventory\Warehouse;
use App\Repositories\Inventory\ProductRepository;
use App\Repositories\Inventory\StorageLocationLeafRepository;
use App\Repositories\Inventory\WarehouseRepository;
use Response;
use Exception;
use Illuminate\Http\Request;

class StockAdjustmentController extends AppBaseController
{
    /** @var  StockAdjustmentRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = StockAdjustmentRepository::class;
    }

    /**
     * Display a listing of the StockAdjustment.
     *
     * @param StockAdjustmentDataTable $stockAdjustmentDataTable
     * @return Response
     */
    public function index(StockAdjustmentDataTable $stockAdjustmentDataTable)
    {
        return $stockAdjustmentDataTable->render('inventory.stock_adjustments.index');
    }

    /**
     * Show the form for creating a new StockAdjustment.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $warehouse = Warehouse::find($request->get('warehouse_id'));
        if (empty($warehouse)) {
            Flash::error(__('messages.not_found', ['model' => __('models/warehouses.singular')]));

            return redirect(route('inventory.stockAdjustments.index'));
        }
        $stockAdjustmentLines = [];
        $stocks = StockProduct::hasQuantity()->all();
        if(!$stocks->isEmpty()){
            foreach($stocks as $stock){
                $stockAdjustmentLines[] = new StockAdjustmentLine([
                    'product_id' => $stock->product_id,
                    'storage_location_id' => $stock->storage_location_id,
                    'count_quantity' => $stock->getRawOriginal('quantity'),
                    'onhand_quantity' => $stock->getRawOriginal('quantity'),
                    'description' => 'same as count system'                    
                ]);
            }
        }
        
        return view('inventory.stock_adjustments.create')
                ->with(['lines' => collect($stockAdjustmentLines), 'warehouse' => $warehouse])
                ->with($this->getOptionItems());
    }

    /**
     * Store a newly created StockAdjustment in storage.
     *
     * @param CreateStockAdjustmentRequest $request
     *
     * @return Response
     */
    public function store(CreateStockAdjustmentRequest $request)
    {
        $input = $request->all();

        $stockAdjustment = $this->getRepositoryObj()->create($input);
        if($stockAdjustment instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockAdjustment->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/stockAdjustments.singular')]));

        return redirect(route('inventory.stockAdjustments.index'));
    }

    /**
     * Display the specified StockAdjustment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockAdjustment = $this->getRepositoryObj()->find($id);

        if (empty($stockAdjustment)) {
            Flash::error(__('models/stockAdjustments.singular').' '.__('messages.not_found'));

            return redirect(route('inventory.stockAdjustments.index'));
        }

        return view('inventory.stock_adjustments.show')->with('stockAdjustment', $stockAdjustment);
    }

    /**
     * Show the form for editing the specified StockAdjustment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockAdjustment = $this->getRepositoryObj()->find($id);

        if (empty($stockAdjustment)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockAdjustments.singular')]));

            return redirect(route('inventory.stockAdjustments.index'));
        }
        
        return view('inventory.stock_adjustments.edit')->with(['stockAdjustment' => $stockAdjustment, 'warehouse' => $stockAdjustment->warehouse,'lines' => $stockAdjustment->stockAdjustmentLines])->with($this->getOptionItems());
    }

    /**
     * Update the specified StockAdjustment in storage.
     *
     * @param  int              $id
     * @param UpdateStockAdjustmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockAdjustmentRequest $request)
    {
        $stockAdjustment = $this->getRepositoryObj()->find($id);

        if (empty($stockAdjustment)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockAdjustments.singular')]));

            return redirect(route('inventory.stockAdjustments.index'));
        }

        $stockAdjustment = $this->getRepositoryObj()->update($request->all(), $id);
        if($stockAdjustment instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockAdjustment->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/stockAdjustments.singular')]));

        return redirect(route('inventory.stockAdjustments.index'));
    }

    /**
     * Remove the specified StockAdjustment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockAdjustment = $this->getRepositoryObj()->find($id);

        if (empty($stockAdjustment)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockAdjustments.singular')]));

            return redirect(route('inventory.stockAdjustments.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/stockAdjustments.singular')]));

        return redirect(route('inventory.stockAdjustments.index'));
    }

    /**
     * Provide options item based on relationship model StockAdjustment from storage.         
     *
     * @throws \Exception
     *
     * @return Response
     */
    private function getOptionItems(){                
        $warehouse = new WarehouseRepository();
        $product = new ProductRepository();
        $location = new StorageLocationLeafRepository();
        return [            
            'warehouseItems' => ['' => __('crud.option.warehouse_placeholder')] + $warehouse->pluck(),
            'productItems' => ['' => __('crud.option.product_placeholder')] + $product->pluck(),
            'locationItems' => ['' => __('crud.option.location_placeholder')] + $location->pluck(),            
        ];
    }
}
