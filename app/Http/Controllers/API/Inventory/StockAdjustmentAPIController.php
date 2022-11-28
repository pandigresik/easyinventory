<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateStockAdjustmentAPIRequest;
use App\Http\Requests\API\Inventory\UpdateStockAdjustmentAPIRequest;
use App\Models\Inventory\StockAdjustment;
use App\Repositories\Inventory\StockAdjustmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Inventory\StockAdjustmentResource;
use Response;

/**
 * Class StockAdjustmentController
 * @package App\Http\Controllers\API\Inventory
 */

class StockAdjustmentAPIController extends AppBaseController
{
    /** @var  StockAdjustmentRepository */
    private $stockAdjustmentRepository;

    public function __construct(StockAdjustmentRepository $stockAdjustmentRepo)
    {
        $this->stockAdjustmentRepository = $stockAdjustmentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/stockAdjustments",
     *      summary="Get a listing of the StockAdjustments.",
     *      tags={"StockAdjustment"},
     *      description="Get all StockAdjustments",
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
     *                  @SWG\Items(ref="#/definitions/StockAdjustment")
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
        $stockAdjustments = $this->stockAdjustmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StockAdjustmentResource::collection($stockAdjustments), 'Stock Adjustments retrieved successfully');
    }

    /**
     * @param CreateStockAdjustmentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/stockAdjustments",
     *      summary="Store a newly created StockAdjustment in storage",
     *      tags={"StockAdjustment"},
     *      description="Store StockAdjustment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StockAdjustment that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StockAdjustment")
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
     *                  ref="#/definitions/StockAdjustment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStockAdjustmentAPIRequest $request)
    {
        $input = $request->all();

        $stockAdjustment = $this->stockAdjustmentRepository->create($input);

        return $this->sendResponse(new StockAdjustmentResource($stockAdjustment), 'Stock Adjustment saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/stockAdjustments/{id}",
     *      summary="Display the specified StockAdjustment",
     *      tags={"StockAdjustment"},
     *      description="Get StockAdjustment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockAdjustment",
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
     *                  ref="#/definitions/StockAdjustment"
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
        /** @var StockAdjustment $stockAdjustment */
        $stockAdjustment = $this->stockAdjustmentRepository->find($id);

        if (empty($stockAdjustment)) {
            return $this->sendError('Stock Adjustment not found');
        }

        return $this->sendResponse(new StockAdjustmentResource($stockAdjustment), 'Stock Adjustment retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStockAdjustmentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/stockAdjustments/{id}",
     *      summary="Update the specified StockAdjustment in storage",
     *      tags={"StockAdjustment"},
     *      description="Update StockAdjustment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockAdjustment",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StockAdjustment that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StockAdjustment")
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
     *                  ref="#/definitions/StockAdjustment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStockAdjustmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var StockAdjustment $stockAdjustment */
        $stockAdjustment = $this->stockAdjustmentRepository->find($id);

        if (empty($stockAdjustment)) {
            return $this->sendError('Stock Adjustment not found');
        }

        $stockAdjustment = $this->stockAdjustmentRepository->update($input, $id);

        return $this->sendResponse(new StockAdjustmentResource($stockAdjustment), 'StockAdjustment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/stockAdjustments/{id}",
     *      summary="Remove the specified StockAdjustment from storage",
     *      tags={"StockAdjustment"},
     *      description="Delete StockAdjustment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockAdjustment",
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
        /** @var StockAdjustment $stockAdjustment */
        $stockAdjustment = $this->stockAdjustmentRepository->find($id);

        if (empty($stockAdjustment)) {
            return $this->sendError('Stock Adjustment not found');
        }

        $stockAdjustment->delete();

        return $this->sendSuccess('Stock Adjustment deleted successfully');
    }
}
