<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\StockMoveDataTable;
use App\Http\Requests\Inventory;
use App\Http\Requests\Inventory\CreateStockMoveRequest;
use App\Http\Requests\Inventory\UpdateStockMoveRequest;
use App\Repositories\Inventory\StockMoveRepository;
use App\Repositories\Inventory\StockMoveTypeRepository;
use App\Repositories\Inventory\WarehouseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class StockMoveController extends AppBaseController
{
    /** @var  StockMoveRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = StockMoveRepository::class;
    }

    /**
     * Display a listing of the StockMove.
     *
     * @param StockMoveDataTable $stockMoveDataTable
     * @return Response
     */
    public function index(StockMoveDataTable $stockMoveDataTable)
    {
        return $stockMoveDataTable->render('inventory.stock_moves.index');
    }

    /**
     * Show the form for creating a new StockMove.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory.stock_moves.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created StockMove in storage.
     *
     * @param CreateStockMoveRequest $request
     *
     * @return Response
     */
    public function store(CreateStockMoveRequest $request)
    {
        $input = $request->all();

        $stockMove = $this->getRepositoryObj()->create($input);
        if($stockMove instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockMove->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/stockMoves.singular')]));

        return redirect(route('inventory.stockMoves.index'));
    }

    /**
     * Display the specified StockMove.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockMove = $this->getRepositoryObj()->find($id);

        if (empty($stockMove)) {
            Flash::error(__('models/stockMoves.singular').' '.__('messages.not_found'));

            return redirect(route('inventory.stockMoves.index'));
        }

        return view('inventory.stock_moves.show')->with('stockMove', $stockMove);
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

            return redirect(route('inventory.stockMoves.index'));
        }
        
        return view('inventory.stock_moves.edit')->with('stockMove', $stockMove)->with($this->getOptionItems());
    }

    /**
     * Update the specified StockMove in storage.
     *
     * @param  int              $id
     * @param UpdateStockMoveRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockMoveRequest $request)
    {
        $stockMove = $this->getRepositoryObj()->find($id);

        if (empty($stockMove)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockMoves.singular')]));

            return redirect(route('inventory.stockMoves.index'));
        }

        $stockMove = $this->getRepositoryObj()->update($request->all(), $id);
        if($stockMove instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockMove->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/stockMoves.singular')]));

        return redirect(route('inventory.stockMoves.index'));
    }

    /**
     * Remove the specified StockMove from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockMove = $this->getRepositoryObj()->find($id);

        if (empty($stockMove)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockMoves.singular')]));

            return redirect(route('inventory.stockMoves.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/stockMoves.singular')]));

        return redirect(route('inventory.stockMoves.index'));
    }

    /**
     * Provide options item based on relationship model StockMove from storage.         
     *
     * @throws \Exception
     *
     * @return Response
     */
    private function getOptionItems(){        
        $stockMoveType = new StockMoveTypeRepository();
        $warehouse = new WarehouseRepository();
        return [
            'stockMoveTypeItems' => ['' => __('crud.option.stockMoveType_placeholder')] + $stockMoveType->pluck(),
            'warehouseItems' => ['' => __('crud.option.warehouse_placeholder')] + $warehouse->pluck()            
        ];
    }
}
