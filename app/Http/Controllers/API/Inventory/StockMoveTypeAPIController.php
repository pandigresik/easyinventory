<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateStockMoveTypeAPIRequest;
use App\Http\Requests\API\Inventory\UpdateStockMoveTypeAPIRequest;
use App\Models\Inventory\StockMoveType;
use App\Repositories\Inventory\StockMoveTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Inventory\StockMoveTypeResource;
use Response;

/**
 * Class StockMoveTypeController
 * @package App\Http\Controllers\API\Inventory
 */

class StockMoveTypeAPIController extends AppBaseController
{
    /** @var  StockMoveTypeRepository */
    private $stockMoveTypeRepository;

    public function __construct(StockMoveTypeRepository $stockMoveTypeRepo)
    {
        $this->stockMoveTypeRepository = $stockMoveTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/stockMoveTypes",
     *      summary="Get a listing of the StockMoveTypes.",
     *      tags={"StockMoveType"},
     *      description="Get all StockMoveTypes",
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
     *                  @SWG\Items(ref="#/definitions/StockMoveType")
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
        $stockMoveTypes = $this->stockMoveTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StockMoveTypeResource::collection($stockMoveTypes), 'Stock Move Types retrieved successfully');
    }

    /**
     * @param CreateStockMoveTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/stockMoveTypes",
     *      summary="Store a newly created StockMoveType in storage",
     *      tags={"StockMoveType"},
     *      description="Store StockMoveType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StockMoveType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StockMoveType")
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
     *                  ref="#/definitions/StockMoveType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStockMoveTypeAPIRequest $request)
    {
        $input = $request->all();

        $stockMoveType = $this->stockMoveTypeRepository->create($input);

        return $this->sendResponse(new StockMoveTypeResource($stockMoveType), 'Stock Move Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/stockMoveTypes/{id}",
     *      summary="Display the specified StockMoveType",
     *      tags={"StockMoveType"},
     *      description="Get StockMoveType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockMoveType",
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
     *                  ref="#/definitions/StockMoveType"
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
        /** @var StockMoveType $stockMoveType */
        $stockMoveType = $this->stockMoveTypeRepository->find($id);

        if (empty($stockMoveType)) {
            return $this->sendError('Stock Move Type not found');
        }

        return $this->sendResponse(new StockMoveTypeResource($stockMoveType), 'Stock Move Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStockMoveTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/stockMoveTypes/{id}",
     *      summary="Update the specified StockMoveType in storage",
     *      tags={"StockMoveType"},
     *      description="Update StockMoveType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockMoveType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StockMoveType that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StockMoveType")
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
     *                  ref="#/definitions/StockMoveType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStockMoveTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var StockMoveType $stockMoveType */
        $stockMoveType = $this->stockMoveTypeRepository->find($id);

        if (empty($stockMoveType)) {
            return $this->sendError('Stock Move Type not found');
        }

        $stockMoveType = $this->stockMoveTypeRepository->update($input, $id);

        return $this->sendResponse(new StockMoveTypeResource($stockMoveType), 'StockMoveType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/stockMoveTypes/{id}",
     *      summary="Remove the specified StockMoveType from storage",
     *      tags={"StockMoveType"},
     *      description="Delete StockMoveType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockMoveType",
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
        /** @var StockMoveType $stockMoveType */
        $stockMoveType = $this->stockMoveTypeRepository->find($id);

        if (empty($stockMoveType)) {
            return $this->sendError('Stock Move Type not found');
        }

        $stockMoveType->delete();

        return $this->sendSuccess('Stock Move Type deleted successfully');
    }
}
