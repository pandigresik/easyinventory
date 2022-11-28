<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\ProductCategoryDataTable;
use App\Http\Requests\Inventory;
use App\Http\Requests\Inventory\CreateProductCategoryRequest;
use App\Http\Requests\Inventory\UpdateProductCategoryRequest;
use App\Repositories\Inventory\ProductCategoryRepository;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class ProductCategoryController extends AppBaseController
{
    /** @var  ProductCategoryRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = ProductCategoryRepository::class;
    }

    /**
     * Display a listing of the ProductCategory.
     *
     * @param ProductCategoryDataTable $productCategoryDataTable
     * @return Response
     */
    public function index(ProductCategoryDataTable $productCategoryDataTable)
    {
        return $productCategoryDataTable->render('inventory.product_categories.index');
    }

    /**
     * Show the form for creating a new ProductCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory.product_categories.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created ProductCategory in storage.
     *
     * @param CreateProductCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateProductCategoryRequest $request)
    {
        $input = $request->all();

        $productCategory = $this->getRepositoryObj()->create($input);
        if($productCategory instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $productCategory->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/productCategories.singular')]));

        return redirect(route('inventory.productCategories.index'));
    }

    /**
     * Display the specified ProductCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productCategory = $this->getRepositoryObj()->find($id);

        if (empty($productCategory)) {
            Flash::error(__('models/productCategories.singular').' '.__('messages.not_found'));

            return redirect(route('inventory.productCategories.index'));
        }

        return view('inventory.product_categories.show')->with('productCategory', $productCategory);
    }

    /**
     * Show the form for editing the specified ProductCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productCategory = $this->getRepositoryObj()->find($id);

        if (empty($productCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/productCategories.singular')]));

            return redirect(route('inventory.productCategories.index'));
        }
        
        return view('inventory.product_categories.edit')->with('productCategory', $productCategory)->with($this->getOptionItems());
    }

    /**
     * Update the specified ProductCategory in storage.
     *
     * @param  int              $id
     * @param UpdateProductCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductCategoryRequest $request)
    {
        $productCategory = $this->getRepositoryObj()->find($id);

        if (empty($productCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/productCategories.singular')]));

            return redirect(route('inventory.productCategories.index'));
        }

        $productCategory = $this->getRepositoryObj()->update($request->all(), $id);
        if($productCategory instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $productCategory->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/productCategories.singular')]));

        return redirect(route('inventory.productCategories.index'));
    }

    /**
     * Remove the specified ProductCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productCategory = $this->getRepositoryObj()->find($id);

        if (empty($productCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/productCategories.singular')]));

            return redirect(route('inventory.productCategories.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/productCategories.singular')]));

        return redirect(route('inventory.productCategories.index'));
    }

    /**
     * Provide options item based on relationship model ProductCategory from storage.         
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
