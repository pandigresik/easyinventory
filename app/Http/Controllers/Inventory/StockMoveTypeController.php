<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\StockMoveTypeDataTable;
use App\Http\Requests\Inventory;
use App\Http\Requests\Inventory\CreateStockMoveTypeRequest;
use App\Http\Requests\Inventory\UpdateStockMoveTypeRequest;
use App\Repositories\Inventory\StockMoveTypeRepository;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class StockMoveTypeController extends AppBaseController
{
    /** @var  StockMoveTypeRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = StockMoveTypeRepository::class;
    }

    /**
     * Display a listing of the StockMoveType.
     *
     * @param StockMoveTypeDataTable $stockMoveTypeDataTable
     * @return Response
     */
    public function index(StockMoveTypeDataTable $stockMoveTypeDataTable)
    {
        return $stockMoveTypeDataTable->render('inventory.stock_move_types.index');
    }

    /**
     * Show the form for creating a new StockMoveType.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory.stock_move_types.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created StockMoveType in storage.
     *
     * @param CreateStockMoveTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateStockMoveTypeRequest $request)
    {
        $input = $request->all();

        $stockMoveType = $this->getRepositoryObj()->create($input);
        if($stockMoveType instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockMoveType->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/stockMoveTypes.singular')]));

        return redirect(route('inventory.stockMoveTypes.index'));
    }

    /**
     * Display the specified StockMoveType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockMoveType = $this->getRepositoryObj()->find($id);

        if (empty($stockMoveType)) {
            Flash::error(__('models/stockMoveTypes.singular').' '.__('messages.not_found'));

            return redirect(route('inventory.stockMoveTypes.index'));
        }

        return view('inventory.stock_move_types.show')->with('stockMoveType', $stockMoveType);
    }

    /**
     * Show the form for editing the specified StockMoveType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockMoveType = $this->getRepositoryObj()->find($id);

        if (empty($stockMoveType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockMoveTypes.singular')]));

            return redirect(route('inventory.stockMoveTypes.index'));
        }
        
        return view('inventory.stock_move_types.edit')->with('stockMoveType', $stockMoveType)->with($this->getOptionItems());
    }

    /**
     * Update the specified StockMoveType in storage.
     *
     * @param  int              $id
     * @param UpdateStockMoveTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockMoveTypeRequest $request)
    {
        $stockMoveType = $this->getRepositoryObj()->find($id);

        if (empty($stockMoveType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockMoveTypes.singular')]));

            return redirect(route('inventory.stockMoveTypes.index'));
        }

        $stockMoveType = $this->getRepositoryObj()->update($request->all(), $id);
        if($stockMoveType instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockMoveType->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/stockMoveTypes.singular')]));

        return redirect(route('inventory.stockMoveTypes.index'));
    }

    /**
     * Remove the specified StockMoveType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockMoveType = $this->getRepositoryObj()->find($id);

        if (empty($stockMoveType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockMoveTypes.singular')]));

            return redirect(route('inventory.stockMoveTypes.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/stockMoveTypes.singular')]));

        return redirect(route('inventory.stockMoveTypes.index'));
    }

    /**
     * Provide options item based on relationship model StockMoveType from storage.         
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
