<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\StockAdjustmentLineDataTable;
use App\Http\Requests\Inventory;
use App\Http\Requests\Inventory\CreateStockAdjustmentLineRequest;
use App\Http\Requests\Inventory\UpdateStockAdjustmentLineRequest;
use App\Repositories\Inventory\StockAdjustmentLineRepository;
use App\Repositories\Inventory\ProductRepository;
use App\Repositories\Inventory\StorageLocationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class StockAdjustmentLineController extends AppBaseController
{
    /** @var  StockAdjustmentLineRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = StockAdjustmentLineRepository::class;
    }

    /**
     * Display a listing of the StockAdjustmentLine.
     *
     * @param StockAdjustmentLineDataTable $stockAdjustmentLineDataTable
     * @return Response
     */
    public function index(StockAdjustmentLineDataTable $stockAdjustmentLineDataTable)
    {
        return $stockAdjustmentLineDataTable->render('inventory.stock_adjustment_lines.index');
    }

    /**
     * Show the form for creating a new StockAdjustmentLine.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory.stock_adjustment_lines.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created StockAdjustmentLine in storage.
     *
     * @param CreateStockAdjustmentLineRequest $request
     *
     * @return Response
     */
    public function store(CreateStockAdjustmentLineRequest $request)
    {
        $input = $request->all();

        $stockAdjustmentLine = $this->getRepositoryObj()->create($input);
        if($stockAdjustmentLine instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockAdjustmentLine->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/stockAdjustmentLines.singular')]));

        return redirect(route('inventory.stockAdjustmentLines.index'));
    }

    /**
     * Display the specified StockAdjustmentLine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockAdjustmentLine = $this->getRepositoryObj()->find($id);

        if (empty($stockAdjustmentLine)) {
            Flash::error(__('models/stockAdjustmentLines.singular').' '.__('messages.not_found'));

            return redirect(route('inventory.stockAdjustmentLines.index'));
        }

        return view('inventory.stock_adjustment_lines.show')->with('stockAdjustmentLine', $stockAdjustmentLine);
    }

    /**
     * Show the form for editing the specified StockAdjustmentLine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockAdjustmentLine = $this->getRepositoryObj()->find($id);

        if (empty($stockAdjustmentLine)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockAdjustmentLines.singular')]));

            return redirect(route('inventory.stockAdjustmentLines.index'));
        }
        
        return view('inventory.stock_adjustment_lines.edit')->with('stockAdjustmentLine', $stockAdjustmentLine)->with($this->getOptionItems());
    }

    /**
     * Update the specified StockAdjustmentLine in storage.
     *
     * @param  int              $id
     * @param UpdateStockAdjustmentLineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockAdjustmentLineRequest $request)
    {
        $stockAdjustmentLine = $this->getRepositoryObj()->find($id);

        if (empty($stockAdjustmentLine)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockAdjustmentLines.singular')]));

            return redirect(route('inventory.stockAdjustmentLines.index'));
        }

        $stockAdjustmentLine = $this->getRepositoryObj()->update($request->all(), $id);
        if($stockAdjustmentLine instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockAdjustmentLine->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/stockAdjustmentLines.singular')]));

        return redirect(route('inventory.stockAdjustmentLines.index'));
    }

    /**
     * Remove the specified StockAdjustmentLine from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockAdjustmentLine = $this->getRepositoryObj()->find($id);

        if (empty($stockAdjustmentLine)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockAdjustmentLines.singular')]));

            return redirect(route('inventory.stockAdjustmentLines.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/stockAdjustmentLines.singular')]));

        return redirect(route('inventory.stockAdjustmentLines.index'));
    }

    /**
     * Provide options item based on relationship model StockAdjustmentLine from storage.         
     *
     * @throws \Exception
     *
     * @return Response
     */
    private function getOptionItems(){        
        $product = new ProductRepository();
        $storageLocation = new StorageLocationRepository();
        return [
            'productItems' => ['' => __('crud.option.product_placeholder')] + $product->pluck(),
            'storageLocationItems' => ['' => __('crud.option.storageLocation_placeholder')] + $storageLocation->pluck()            
        ];
    }
}
