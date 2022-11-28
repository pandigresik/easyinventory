<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateUomAPIRequest;
use App\Http\Requests\API\Inventory\UpdateUomAPIRequest;
use App\Models\Inventory\Uom;
use App\Repositories\Inventory\UomRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Inventory\UomResource;
use Response;

/**
 * Class UomController
 * @package App\Http\Controllers\API\Inventory
 */

class UomAPIController extends AppBaseController
{
    /** @var  UomRepository */
    private $uomRepository;

    public function __construct(UomRepository $uomRepo)
    {
        $this->uomRepository = $uomRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/uoms",
     *      summary="Get a listing of the Uoms.",
     *      tags={"Uom"},
     *      description="Get all Uoms",
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
     *                  @SWG\Items(ref="#/definitions/Uom")
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
        $uoms = $this->uomRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(UomResource::collection($uoms), 'Uoms retrieved successfully');
    }

    /**
     * @param CreateUomAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/uoms",
     *      summary="Store a newly created Uom in storage",
     *      tags={"Uom"},
     *      description="Store Uom",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Uom that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Uom")
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
     *                  ref="#/definitions/Uom"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUomAPIRequest $request)
    {
        $input = $request->all();

        $uom = $this->uomRepository->create($input);

        return $this->sendResponse(new UomResource($uom), 'Uom saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/uoms/{id}",
     *      summary="Display the specified Uom",
     *      tags={"Uom"},
     *      description="Get Uom",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Uom",
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
     *                  ref="#/definitions/Uom"
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
        /** @var Uom $uom */
        $uom = $this->uomRepository->find($id);

        if (empty($uom)) {
            return $this->sendError('Uom not found');
        }

        return $this->sendResponse(new UomResource($uom), 'Uom retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUomAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/uoms/{id}",
     *      summary="Update the specified Uom in storage",
     *      tags={"Uom"},
     *      description="Update Uom",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Uom",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Uom that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Uom")
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
     *                  ref="#/definitions/Uom"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUomAPIRequest $request)
    {
        $input = $request->all();

        /** @var Uom $uom */
        $uom = $this->uomRepository->find($id);

        if (empty($uom)) {
            return $this->sendError('Uom not found');
        }

        $uom = $this->uomRepository->update($input, $id);

        return $this->sendResponse(new UomResource($uom), 'Uom updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/uoms/{id}",
     *      summary="Remove the specified Uom from storage",
     *      tags={"Uom"},
     *      description="Delete Uom",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Uom",
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
        /** @var Uom $uom */
        $uom = $this->uomRepository->find($id);

        if (empty($uom)) {
            return $this->sendError('Uom not found');
        }

        $uom->delete();

        return $this->sendSuccess('Uom deleted successfully');
    }
}
