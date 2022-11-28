<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\UomCategoryDataTable;
use App\Http\Requests\Inventory;
use App\Http\Requests\Inventory\CreateUomCategoryRequest;
use App\Http\Requests\Inventory\UpdateUomCategoryRequest;
use App\Repositories\Inventory\UomCategoryRepository;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class UomCategoryController extends AppBaseController
{
    /** @var  UomCategoryRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = UomCategoryRepository::class;
    }

    /**
     * Display a listing of the UomCategory.
     *
     * @param UomCategoryDataTable $uomCategoryDataTable
     * @return Response
     */
    public function index(UomCategoryDataTable $uomCategoryDataTable)
    {
        return $uomCategoryDataTable->render('inventory.uom_categories.index');
    }

    /**
     * Show the form for creating a new UomCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory.uom_categories.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created UomCategory in storage.
     *
     * @param CreateUomCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateUomCategoryRequest $request)
    {
        $input = $request->all();

        $uomCategory = $this->getRepositoryObj()->create($input);
        if($uomCategory instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $uomCategory->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/uomCategories.singular')]));

        return redirect(route('inventory.uomCategories.index'));
    }

    /**
     * Display the specified UomCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $uomCategory = $this->getRepositoryObj()->find($id);

        if (empty($uomCategory)) {
            Flash::error(__('models/uomCategories.singular').' '.__('messages.not_found'));

            return redirect(route('inventory.uomCategories.index'));
        }

        return view('inventory.uom_categories.show')->with('uomCategory', $uomCategory);
    }

    /**
     * Show the form for editing the specified UomCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $uomCategory = $this->getRepositoryObj()->find($id);

        if (empty($uomCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/uomCategories.singular')]));

            return redirect(route('inventory.uomCategories.index'));
        }
        
        return view('inventory.uom_categories.edit')->with('uomCategory', $uomCategory)->with($this->getOptionItems());
    }

    /**
     * Update the specified UomCategory in storage.
     *
     * @param  int              $id
     * @param UpdateUomCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUomCategoryRequest $request)
    {
        $uomCategory = $this->getRepositoryObj()->find($id);

        if (empty($uomCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/uomCategories.singular')]));

            return redirect(route('inventory.uomCategories.index'));
        }

        $uomCategory = $this->getRepositoryObj()->update($request->all(), $id);
        if($uomCategory instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $uomCategory->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/uomCategories.singular')]));

        return redirect(route('inventory.uomCategories.index'));
    }

    /**
     * Remove the specified UomCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $uomCategory = $this->getRepositoryObj()->find($id);

        if (empty($uomCategory)) {
            Flash::error(__('messages.not_found', ['model' => __('models/uomCategories.singular')]));

            return redirect(route('inventory.uomCategories.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/uomCategories.singular')]));

        return redirect(route('inventory.uomCategories.index'));
    }

    /**
     * Provide options item based on relationship model UomCategory from storage.         
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
