<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\UomDataTable;
use App\Http\Requests\Inventory;
use App\Http\Requests\Inventory\CreateUomRequest;
use App\Http\Requests\Inventory\UpdateUomRequest;
use App\Repositories\Inventory\UomRepository;
use App\Repositories\Inventory\UomCategoryRepository;
use App\Repositories\Inventory\UomTypeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Inventory\Uom;
use Response;
use Exception;

class UomController extends AppBaseController
{
    /** @var  UomRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = UomRepository::class;
    }

    /**
     * Display a listing of the Uom.
     *
     * @param UomDataTable $uomDataTable
     * @return Response
     */
    public function index(UomDataTable $uomDataTable)
    {
        return $uomDataTable->render('inventory.uoms.index');
    }

    /**
     * Show the form for creating a new Uom.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory.uoms.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created Uom in storage.
     *
     * @param CreateUomRequest $request
     *
     * @return Response
     */
    public function store(CreateUomRequest $request)
    {
        $input = $request->all();

        $uom = $this->getRepositoryObj()->create($input);
        if($uom instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $uom->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/uoms.singular')]));

        return redirect(route('inventory.uoms.index'));
    }

    /**
     * Display the specified Uom.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $uom = $this->getRepositoryObj()->find($id);

        if (empty($uom)) {
            Flash::error(__('models/uoms.singular').' '.__('messages.not_found'));

            return redirect(route('inventory.uoms.index'));
        }

        return view('inventory.uoms.show')->with('uom', $uom);
    }

    /**
     * Show the form for editing the specified Uom.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $uom = $this->getRepositoryObj()->find($id);

        if (empty($uom)) {
            Flash::error(__('messages.not_found', ['model' => __('models/uoms.singular')]));

            return redirect(route('inventory.uoms.index'));
        }
        
        return view('inventory.uoms.edit')->with('uom', $uom)->with($this->getOptionItems());
    }

    /**
     * Update the specified Uom in storage.
     *
     * @param  int              $id
     * @param UpdateUomRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUomRequest $request)
    {
        $uom = $this->getRepositoryObj()->find($id);

        if (empty($uom)) {
            Flash::error(__('messages.not_found', ['model' => __('models/uoms.singular')]));

            return redirect(route('inventory.uoms.index'));
        }

        $uom = $this->getRepositoryObj()->update($request->all(), $id);
        if($uom instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $uom->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/uoms.singular')]));

        return redirect(route('inventory.uoms.index'));
    }

    /**
     * Remove the specified Uom from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $uom = $this->getRepositoryObj()->find($id);

        if (empty($uom)) {
            Flash::error(__('messages.not_found', ['model' => __('models/uoms.singular')]));

            return redirect(route('inventory.uoms.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/uoms.singular')]));

        return redirect(route('inventory.uoms.index'));
    }

    /**
     * Provide options item based on relationship model Uom from storage.         
     *
     * @throws \Exception
     *
     * @return Response
     */
    private function getOptionItems(){        
        $uomCategory = new UomCategoryRepository();        
        return [
            'uomCategoryItems' => ['' => __('crud.option.uomCategory_placeholder')] + $uomCategory->pluck(),
            'uomTypeItems' => array_combine(Uom::UOM_TYPE, Uom::UOM_TYPE)
        ];
    }
}
