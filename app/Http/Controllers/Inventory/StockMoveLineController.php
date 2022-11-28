<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\StockMoveLineDataTable;
use App\Http\Requests\Inventory;
use App\Http\Requests\Inventory\CreateStockMoveLineRequest;
use App\Http\Requests\Inventory\UpdateStockMoveLineRequest;
use App\Repositories\Inventory\StockMoveLineRepository;
use App\Repositories\Inventory\ProductRepository;
use App\Repositories\Inventory\StockMoveRepository;
use App\Repositories\Inventory\StorageLocationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class StockMoveLineController extends AppBaseController
{
    /** @var  StockMoveLineRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = StockMoveLineRepository::class;
    }

    /**
     * Display a listing of the StockMoveLine.
     *
     * @param StockMoveLineDataTable $stockMoveLineDataTable
     * @return Response
     */
    public function index(StockMoveLineDataTable $stockMoveLineDataTable)
    {
        return $stockMoveLineDataTable->render('inventory.stock_move_lines.index');
    }

    /**
     * Show the form for creating a new StockMoveLine.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory.stock_move_lines.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created StockMoveLine in storage.
     *
     * @param CreateStockMoveLineRequest $request
     *
     * @return Response
     */
    public function store(CreateStockMoveLineRequest $request)
    {
        $input = $request->all();

        $stockMoveLine = $this->getRepositoryObj()->create($input);
        if($stockMoveLine instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockMoveLine->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/stockMoveLines.singular')]));

        return redirect(route('inventory.stockMoveLines.index'));
    }

    /**
     * Display the specified StockMoveLine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockMoveLine = $this->getRepositoryObj()->find($id);

        if (empty($stockMoveLine)) {
            Flash::error(__('models/stockMoveLines.singular').' '.__('messages.not_found'));

            return redirect(route('inventory.stockMoveLines.index'));
        }

        return view('inventory.stock_move_lines.show')->with('stockMoveLine', $stockMoveLine);
    }

    /**
     * Show the form for editing the specified StockMoveLine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockMoveLine = $this->getRepositoryObj()->find($id);

        if (empty($stockMoveLine)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockMoveLines.singular')]));

            return redirect(route('inventory.stockMoveLines.index'));
        }
        
        return view('inventory.stock_move_lines.edit')->with('stockMoveLine', $stockMoveLine)->with($this->getOptionItems());
    }

    /**
     * Update the specified StockMoveLine in storage.
     *
     * @param  int              $id
     * @param UpdateStockMoveLineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockMoveLineRequest $request)
    {
        $stockMoveLine = $this->getRepositoryObj()->find($id);

        if (empty($stockMoveLine)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockMoveLines.singular')]));

            return redirect(route('inventory.stockMoveLines.index'));
        }

        $stockMoveLine = $this->getRepositoryObj()->update($request->all(), $id);
        if($stockMoveLine instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockMoveLine->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/stockMoveLines.singular')]));

        return redirect(route('inventory.stockMoveLines.index'));
    }

    /**
     * Remove the specified StockMoveLine from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockMoveLine = $this->getRepositoryObj()->find($id);

        if (empty($stockMoveLine)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockMoveLines.singular')]));

            return redirect(route('inventory.stockMoveLines.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/stockMoveLines.singular')]));

        return redirect(route('inventory.stockMoveLines.index'));
    }

    /**
     * Provide options item based on relationship model StockMoveLine from storage.         
     *
     * @throws \Exception
     *
     * @return Response
     */
    private function getOptionItems(){        
        $product = new ProductRepository();
        $stockMove = new StockMoveRepository();
        $storageLocation = new StorageLocationRepository();
        return [
            'productItems' => ['' => __('crud.option.product_placeholder')] + $product->pluck(),
            'stockMoveItems' => ['' => __('crud.option.stockMove_placeholder')] + $stockMove->pluck(),
            'storageLocationItems' => ['' => __('crud.option.storageLocation_placeholder')] + $storageLocation->pluck()            
        ];
    }
}
