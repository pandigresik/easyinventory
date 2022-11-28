<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateStockAdjustmentLineAPIRequest;
use App\Http\Requests\API\Inventory\UpdateStockAdjustmentLineAPIRequest;
use App\Models\Inventory\StockAdjustmentLine;
use App\Repositories\Inventory\StockAdjustmentLineRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Inventory\StockAdjustmentLineResource;
use Response;

/**
 * Class StockAdjustmentLineController
 * @package App\Http\Controllers\API\Inventory
 */

class StockAdjustmentLineAPIController extends AppBaseController
{
    /** @var  StockAdjustmentLineRepository */
    private $stockAdjustmentLineRepository;

    public function __construct(StockAdjustmentLineRepository $stockAdjustmentLineRepo)
    {
        $this->stockAdjustmentLineRepository = $stockAdjustmentLineRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/stockAdjustmentLines",
     *      summary="Get a listing of the StockAdjustmentLines.",
     *      tags={"StockAdjustmentLine"},
     *      description="Get all StockAdjustmentLines",
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
     *                  @SWG\Items(ref="#/definitions/StockAdjustmentLine")
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
        $stockAdjustmentLines = $this->stockAdjustmentLineRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StockAdjustmentLineResource::collection($stockAdjustmentLines), 'Stock Adjustment Lines retrieved successfully');
    }

    /**
     * @param CreateStockAdjustmentLineAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/stockAdjustmentLines",
     *      summary="Store a newly created StockAdjustmentLine in storage",
     *      tags={"StockAdjustmentLine"},
     *      description="Store StockAdjustmentLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StockAdjustmentLine that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StockAdjustmentLine")
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
     *                  ref="#/definitions/StockAdjustmentLine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStockAdjustmentLineAPIRequest $request)
    {
        $input = $request->all();

        $stockAdjustmentLine = $this->stockAdjustmentLineRepository->create($input);

        return $this->sendResponse(new StockAdjustmentLineResource($stockAdjustmentLine), 'Stock Adjustment Line saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/stockAdjustmentLines/{id}",
     *      summary="Display the specified StockAdjustmentLine",
     *      tags={"StockAdjustmentLine"},
     *      description="Get StockAdjustmentLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockAdjustmentLine",
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
     *                  ref="#/definitions/StockAdjustmentLine"
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
        /** @var StockAdjustmentLine $stockAdjustmentLine */
        $stockAdjustmentLine = $this->stockAdjustmentLineRepository->find($id);

        if (empty($stockAdjustmentLine)) {
            return $this->sendError('Stock Adjustment Line not found');
        }

        return $this->sendResponse(new StockAdjustmentLineResource($stockAdjustmentLine), 'Stock Adjustment Line retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStockAdjustmentLineAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/stockAdjustmentLines/{id}",
     *      summary="Update the specified StockAdjustmentLine in storage",
     *      tags={"StockAdjustmentLine"},
     *      description="Update StockAdjustmentLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockAdjustmentLine",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StockAdjustmentLine that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StockAdjustmentLine")
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
     *                  ref="#/definitions/StockAdjustmentLine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStockAdjustmentLineAPIRequest $request)
    {
        $input = $request->all();

        /** @var StockAdjustmentLine $stockAdjustmentLine */
        $stockAdjustmentLine = $this->stockAdjustmentLineRepository->find($id);

        if (empty($stockAdjustmentLine)) {
            return $this->sendError('Stock Adjustment Line not found');
        }

        $stockAdjustmentLine = $this->stockAdjustmentLineRepository->update($input, $id);

        return $this->sendResponse(new StockAdjustmentLineResource($stockAdjustmentLine), 'StockAdjustmentLine updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/stockAdjustmentLines/{id}",
     *      summary="Remove the specified StockAdjustmentLine from storage",
     *      tags={"StockAdjustmentLine"},
     *      description="Delete StockAdjustmentLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockAdjustmentLine",
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
        /** @var StockAdjustmentLine $stockAdjustmentLine */
        $stockAdjustmentLine = $this->stockAdjustmentLineRepository->find($id);

        if (empty($stockAdjustmentLine)) {
            return $this->sendError('Stock Adjustment Line not found');
        }

        $stockAdjustmentLine->delete();

        return $this->sendSuccess('Stock Adjustment Line deleted successfully');
    }
}
