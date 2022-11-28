<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\WarehouseDataTable;
use App\Http\Requests\Inventory;
use App\Http\Requests\Inventory\CreateWarehouseRequest;
use App\Http\Requests\Inventory\UpdateWarehouseRequest;
use App\Repositories\Inventory\WarehouseRepository;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class WarehouseController extends AppBaseController
{
    /** @var  WarehouseRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = WarehouseRepository::class;
    }

    /**
     * Display a listing of the Warehouse.
     *
     * @param WarehouseDataTable $warehouseDataTable
     * @return Response
     */
    public function index(WarehouseDataTable $warehouseDataTable)
    {
        return $warehouseDataTable->render('inventory.warehouses.index');
    }

    /**
     * Show the form for creating a new Warehouse.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory.warehouses.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created Warehouse in storage.
     *
     * @param CreateWarehouseRequest $request
     *
     * @return Response
     */
    public function store(CreateWarehouseRequest $request)
    {
        $input = $request->all();

        $warehouse = $this->getRepositoryObj()->create($input);
        if($warehouse instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $warehouse->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/warehouses.singular')]));

        return redirect(route('inventory.warehouses.index'));
    }

    /**
     * Display the specified Warehouse.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $warehouse = $this->getRepositoryObj()->find($id);

        if (empty($warehouse)) {
            Flash::error(__('models/warehouses.singular').' '.__('messages.not_found'));

            return redirect(route('inventory.warehouses.index'));
        }

        return view('inventory.warehouses.show')->with('warehouse', $warehouse);
    }

    /**
     * Show the form for editing the specified Warehouse.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $warehouse = $this->getRepositoryObj()->find($id);

        if (empty($warehouse)) {
            Flash::error(__('messages.not_found', ['model' => __('models/warehouses.singular')]));

            return redirect(route('inventory.warehouses.index'));
        }
        
        return view('inventory.warehouses.edit')->with('warehouse', $warehouse)->with($this->getOptionItems());
    }

    /**
     * Update the specified Warehouse in storage.
     *
     * @param  int              $id
     * @param UpdateWarehouseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWarehouseRequest $request)
    {
        $warehouse = $this->getRepositoryObj()->find($id);

        if (empty($warehouse)) {
            Flash::error(__('messages.not_found', ['model' => __('models/warehouses.singular')]));

            return redirect(route('inventory.warehouses.index'));
        }

        $warehouse = $this->getRepositoryObj()->update($request->all(), $id);
        if($warehouse instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $warehouse->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/warehouses.singular')]));

        return redirect(route('inventory.warehouses.index'));
    }

    /**
     * Remove the specified Warehouse from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $warehouse = $this->getRepositoryObj()->find($id);

        if (empty($warehouse)) {
            Flash::error(__('messages.not_found', ['model' => __('models/warehouses.singular')]));

            return redirect(route('inventory.warehouses.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/warehouses.singular')]));

        return redirect(route('inventory.warehouses.index'));
    }

    /**
     * Provide options item based on relationship model Warehouse from storage.         
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
