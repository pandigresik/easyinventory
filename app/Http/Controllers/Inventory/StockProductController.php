<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\StockProductDataTable;
use App\Http\Requests\Inventory;
use App\Http\Requests\Inventory\CreateStockProductRequest;
use App\Http\Requests\Inventory\UpdateStockProductRequest;
use App\Repositories\Inventory\StockProductRepository;
use App\Repositories\Inventory\ProductRepository;
use App\Repositories\Inventory\StorageLocationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class StockProductController extends AppBaseController
{
    /** @var  StockProductRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = StockProductRepository::class;
    }

    /**
     * Display a listing of the StockProduct.
     *
     * @param StockProductDataTable $stockProductDataTable
     * @return Response
     */
    public function index(StockProductDataTable $stockProductDataTable)
    {
        return $stockProductDataTable->render('inventory.stock_products.index');
    }

    /**
     * Show the form for creating a new StockProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory.stock_products.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created StockProduct in storage.
     *
     * @param CreateStockProductRequest $request
     *
     * @return Response
     */
    public function store(CreateStockProductRequest $request)
    {
        $input = $request->all();

        $stockProduct = $this->getRepositoryObj()->create($input);
        if($stockProduct instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockProduct->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/stockProducts.singular')]));

        return redirect(route('inventory.stockProducts.index'));
    }

    /**
     * Display the specified StockProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockProduct = $this->getRepositoryObj()->find($id);

        if (empty($stockProduct)) {
            Flash::error(__('models/stockProducts.singular').' '.__('messages.not_found'));

            return redirect(route('inventory.stockProducts.index'));
        }

        return view('inventory.stock_products.show')->with('stockProduct', $stockProduct);
    }

    /**
     * Show the form for editing the specified StockProduct.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockProduct = $this->getRepositoryObj()->find($id);

        if (empty($stockProduct)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockProducts.singular')]));

            return redirect(route('inventory.stockProducts.index'));
        }
        
        return view('inventory.stock_products.edit')->with('stockProduct', $stockProduct)->with($this->getOptionItems());
    }

    /**
     * Update the specified StockProduct in storage.
     *
     * @param  int              $id
     * @param UpdateStockProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockProductRequest $request)
    {
        $stockProduct = $this->getRepositoryObj()->find($id);

        if (empty($stockProduct)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockProducts.singular')]));

            return redirect(route('inventory.stockProducts.index'));
        }

        $stockProduct = $this->getRepositoryObj()->update($request->all(), $id);
        if($stockProduct instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $stockProduct->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/stockProducts.singular')]));

        return redirect(route('inventory.stockProducts.index'));
    }

    /**
     * Remove the specified StockProduct from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockProduct = $this->getRepositoryObj()->find($id);

        if (empty($stockProduct)) {
            Flash::error(__('messages.not_found', ['model' => __('models/stockProducts.singular')]));

            return redirect(route('inventory.stockProducts.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/stockProducts.singular')]));

        return redirect(route('inventory.stockProducts.index'));
    }

    /**
     * Provide options item based on relationship model StockProduct from storage.         
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
