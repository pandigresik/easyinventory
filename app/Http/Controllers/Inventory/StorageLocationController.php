<?php

namespace App\Http\Controllers\Inventory;

use App\DataTables\Inventory\StorageLocationDataTable;
use App\Http\Requests\Inventory;
use App\Http\Requests\Inventory\CreateStorageLocationRequest;
use App\Http\Requests\Inventory\UpdateStorageLocationRequest;
use App\Repositories\Inventory\StorageLocationRepository;
use App\Repositories\Inventory\WarehouseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class StorageLocationController extends AppBaseController
{
    /** @var  StorageLocationRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = StorageLocationRepository::class;
    }

    /**
     * Display a listing of the StorageLocation.
     *
     * @param StorageLocationDataTable $storageLocationDataTable
     * @return Response
     */
    public function index(StorageLocationDataTable $storageLocationDataTable)
    {
        return $storageLocationDataTable->render('inventory.storage_locations.index');
    }

    /**
     * Show the form for creating a new StorageLocation.
     *
     * @return Response
     */
    public function create()
    {
        return view('inventory.storage_locations.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created StorageLocation in storage.
     *
     * @param CreateStorageLocationRequest $request
     *
     * @return Response
     */
    public function store(CreateStorageLocationRequest $request)
    {
        $input = $request->all();

        $storageLocation = $this->getRepositoryObj()->create($input);
        if($storageLocation instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $storageLocation->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/storageLocations.singular')]));

        return redirect(route('inventory.storageLocations.index'));
    }

    /**
     * Display the specified StorageLocation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $storageLocation = $this->getRepositoryObj()->find($id);

        if (empty($storageLocation)) {
            Flash::error(__('models/storageLocations.singular').' '.__('messages.not_found'));

            return redirect(route('inventory.storageLocations.index'));
        }

        return view('inventory.storage_locations.show')->with('storageLocation', $storageLocation);
    }

    /**
     * Show the form for editing the specified StorageLocation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $storageLocation = $this->getRepositoryObj()->find($id);

        if (empty($storageLocation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/storageLocations.singular')]));

            return redirect(route('inventory.storageLocations.index'));
        }
        
        return view('inventory.storage_locations.edit')->with('storageLocation', $storageLocation)->with($this->getOptionItems());
    }

    /**
     * Update the specified StorageLocation in storage.
     *
     * @param  int              $id
     * @param UpdateStorageLocationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStorageLocationRequest $request)
    {
        $storageLocation = $this->getRepositoryObj()->find($id);

        if (empty($storageLocation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/storageLocations.singular')]));

            return redirect(route('inventory.storageLocations.index'));
        }

        $storageLocation = $this->getRepositoryObj()->update($request->all(), $id);
        if($storageLocation instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $storageLocation->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/storageLocations.singular')]));

        return redirect(route('inventory.storageLocations.index'));
    }

    /**
     * Remove the specified StorageLocation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $storageLocation = $this->getRepositoryObj()->find($id);

        if (empty($storageLocation)) {
            Flash::error(__('messages.not_found', ['model' => __('models/storageLocations.singular')]));

            return redirect(route('inventory.storageLocations.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/storageLocations.singular')]));

        return redirect(route('inventory.storageLocations.index'));
    }

    /**
     * Provide options item based on relationship model StorageLocation from storage.         
     *
     * @throws \Exception
     *
     * @return Response
     */
    private function getOptionItems(){        
        $warehouse = new WarehouseRepository();
        $storageLocation = new StorageLocationRepository();
        return [
            'warehouseItems' => ['' => __('crud.option.warehouse_placeholder')] + $warehouse->pluck(),
            'parentItems' =>  ['' => __('crud.option.storageLocation_placeholder')] + $storageLocation->allQuery()->with(['warehouse'])->get()
                ->groupBy('warehouse.name')->map(function($item){
                    return $item->pluck('name', 'id');
            })->toArray(),
        ];
    }
}
