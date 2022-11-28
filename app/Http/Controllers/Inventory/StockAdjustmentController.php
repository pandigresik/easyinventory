<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\StockAdjustmentDataTable;
use App\Http\Requests\Inventory;
use App\Http\Requests\Inventory\CreateStockAdjustmentRequest;
use App\Http\Requests\Inventory\UpdateStockAdjustmentRequest;
use App\Repositories\Inventory\StockAdjustmentRepository;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

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
    public function create()
    {
        return view('inventory.stock_adjustments.create')->with($this->getOptionItems());
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
        
        return view('inventory.stock_adjustments.edit')->with('stockAdjustment', $stockAdjustment)->with($this->getOptionItems());
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
        
        return [
                        
        ];
    }
}
