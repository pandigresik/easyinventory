<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\StockMoveDataTable;
use App\Http\Requests\Inventory\CreateStockMoveRequest;
use App\Http\Requests\Inventory\UpdateStockMoveRequest;
use App\Repositories\Inventory\StockMoveRepository;
use App\Repositories\Inventory\WarehouseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Inventory\ProductRepository;
use App\Repositories\Inventory\StorageLocationLeafRepository;
use Response;
use Exception;

class StockMoveController extends AppBaseController
{
    /** @var  StockMoveRepository */
    protected $repository;
    protected $baseView = 'inventory.stock_moves';
    protected $baseRoute = 'inventory.stockMoves';
    
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
        return $stockMoveDataTable->setMoveType($this->getRepositoryObj()->getMoveType())->setBaseRoute($this->baseRoute)->render($this->baseView.'.index', ['baseView' => $this->baseView, 'baseRoute' => $this->baseRoute]);
    }

    /**
     * Show the form for creating a new StockMove.
     *
     * @return Response
     */
    public function create()
    {
        return view($this->baseView.'.create')->with($this->getOptionItems());
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

        return redirect(route($this->baseRoute.'.index'));
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

            return redirect(route($this->baseRoute.'.index'));
        }

        return view($this->baseView.'.show')->with('stockMove', $stockMove);
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
        
        return view($this->baseView.'.edit')->with(['stockMove' => $stockMove, 'lines' => $stockMove->stockMoveLines])->with($this->getOptionItems());
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

            return redirect(route($this->baseRoute.'.index'));
        }

        $stockMove = $this->getRepositoryObj()->update($request->all(), $id);
        if($stockMove instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockMove->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/stockMoves.singular')]));

        return redirect(route($this->baseRoute.'.index'));
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

            return redirect(route($this->baseRoute.'.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/stockMoves.singular')]));

        return redirect(route($this->baseRoute.'.index'));
    }

    /**
     * Provide options item based on relationship model StockMove from storage.         
     *
     * @throws \Exception
     *
     * @return Response
     */
    protected function getOptionItems(){        
        $warehouse = new WarehouseRepository();
        $product = new ProductRepository();
        $location = new StorageLocationLeafRepository();
        return [            
            'warehouseItems' => ['' => __('crud.option.warehouse_placeholder')] + $warehouse->pluck(),
            'productItems' => ['' => __('crud.option.product_placeholder')] + $product->pluck(),
            'locationItems' => ['' => __('crud.option.location_placeholder')] + $location->pluck(),
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute
        ];
    }
}
