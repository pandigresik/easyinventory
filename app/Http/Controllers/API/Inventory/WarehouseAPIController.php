<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateWarehouseAPIRequest;
use App\Http\Requests\API\Inventory\UpdateWarehouseAPIRequest;
use App\Models\Inventory\Warehouse;
use App\Repositories\Inventory\WarehouseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Inventory\WarehouseResource;
use Response;

/**
 * Class WarehouseController
 * @package App\Http\Controllers\API\Inventory
 */

class WarehouseAPIController extends AppBaseController
{
    /** @var  WarehouseRepository */
    private $warehouseRepository;

    public function __construct(WarehouseRepository $warehouseRepo)
    {
        $this->warehouseRepository = $warehouseRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/warehouses",
     *      summary="Get a listing of the Warehouses.",
     *      tags={"Warehouse"},
     *      description="Get all Warehouses",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Warehouse")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $warehouses = $this->warehouseRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(WarehouseResource::collection($warehouses), 'Warehouses retrieved successfully');
    }

    /**
     * @param CreateWarehouseAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/warehouses",
     *      summary="Store a newly created Warehouse in storage",
     *      tags={"Warehouse"},
     *      description="Store Warehouse",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Warehouse that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Warehouse")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Warehouse"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateWarehouseAPIRequest $request)
    {
        $input = $request->all();

        $warehouse = $this->warehouseRepository->create($input);

        return $this->sendResponse(new WarehouseResource($warehouse), 'Warehouse saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/warehouses/{id}",
     *      summary="Display the specified Warehouse",
     *      tags={"Warehouse"},
     *      description="Get Warehouse",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Warehouse",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Warehouse"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Warehouse $warehouse */
        $warehouse = $this->warehouseRepository->find($id);

        if (empty($warehouse)) {
            return $this->sendError('Warehouse not found');
        }

        return $this->sendResponse(new WarehouseResource($warehouse), 'Warehouse retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateWarehouseAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/warehouses/{id}",
     *      summary="Update the specified Warehouse in storage",
     *      tags={"Warehouse"},
     *      description="Update Warehouse",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Warehouse",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Warehouse that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Warehouse")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Warehouse"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateWarehouseAPIRequest $request)
    {
        $input = $request->all();

        /** @var Warehouse $warehouse */
        $warehouse = $this->warehouseRepository->find($id);

        if (empty($warehouse)) {
            return $this->sendError('Warehouse not found');
        }

        $warehouse = $this->warehouseRepository->update($input, $id);

        return $this->sendResponse(new WarehouseResource($warehouse), 'Warehouse updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/warehouses/{id}",
     *      summary="Remove the specified Warehouse from storage",
     *      tags={"Warehouse"},
     *      description="Delete Warehouse",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Warehouse",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Warehouse $warehouse */
        $warehouse = $this->warehouseRepository->find($id);

        if (empty($warehouse)) {
            return $this->sendError('Warehouse not found');
        }

        $warehouse->delete();

        return $this->sendSuccess('Warehouse deleted successfully');
    }
}
