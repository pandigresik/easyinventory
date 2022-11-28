<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateStorageLocationAPIRequest;
use App\Http\Requests\API\Inventory\UpdateStorageLocationAPIRequest;
use App\Models\Inventory\StorageLocation;
use App\Repositories\Inventory\StorageLocationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Inventory\StorageLocationResource;
use Response;

/**
 * Class StorageLocationController
 * @package App\Http\Controllers\API\Inventory
 */

class StorageLocationAPIController extends AppBaseController
{
    /** @var  StorageLocationRepository */
    private $storageLocationRepository;

    public function __construct(StorageLocationRepository $storageLocationRepo)
    {
        $this->storageLocationRepository = $storageLocationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/storageLocations",
     *      summary="Get a listing of the StorageLocations.",
     *      tags={"StorageLocation"},
     *      description="Get all StorageLocations",
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
     *                  @SWG\Items(ref="#/definitions/StorageLocation")
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
        $storageLocations = $this->storageLocationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StorageLocationResource::collection($storageLocations), 'Storage Locations retrieved successfully');
    }

    /**
     * @param CreateStorageLocationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/storageLocations",
     *      summary="Store a newly created StorageLocation in storage",
     *      tags={"StorageLocation"},
     *      description="Store StorageLocation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StorageLocation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StorageLocation")
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
     *                  ref="#/definitions/StorageLocation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStorageLocationAPIRequest $request)
    {
        $input = $request->all();

        $storageLocation = $this->storageLocationRepository->create($input);

        return $this->sendResponse(new StorageLocationResource($storageLocation), 'Storage Location saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/storageLocations/{id}",
     *      summary="Display the specified StorageLocation",
     *      tags={"StorageLocation"},
     *      description="Get StorageLocation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StorageLocation",
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
     *                  ref="#/definitions/StorageLocation"
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
        /** @var StorageLocation $storageLocation */
        $storageLocation = $this->storageLocationRepository->find($id);

        if (empty($storageLocation)) {
            return $this->sendError('Storage Location not found');
        }

        return $this->sendResponse(new StorageLocationResource($storageLocation), 'Storage Location retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStorageLocationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/storageLocations/{id}",
     *      summary="Update the specified StorageLocation in storage",
     *      tags={"StorageLocation"},
     *      description="Update StorageLocation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StorageLocation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StorageLocation that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StorageLocation")
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
     *                  ref="#/definitions/StorageLocation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStorageLocationAPIRequest $request)
    {
        $input = $request->all();

        /** @var StorageLocation $storageLocation */
        $storageLocation = $this->storageLocationRepository->find($id);

        if (empty($storageLocation)) {
            return $this->sendError('Storage Location not found');
        }

        $storageLocation = $this->storageLocationRepository->update($input, $id);

        return $this->sendResponse(new StorageLocationResource($storageLocation), 'StorageLocation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/storageLocations/{id}",
     *      summary="Remove the specified StorageLocation from storage",
     *      tags={"StorageLocation"},
     *      description="Delete StorageLocation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StorageLocation",
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
        /** @var StorageLocation $storageLocation */
        $storageLocation = $this->storageLocationRepository->find($id);

        if (empty($storageLocation)) {
            return $this->sendError('Storage Location not found');
        }

        $storageLocation->delete();

        return $this->sendSuccess('Storage Location deleted successfully');
    }
}
