<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateStockMoveLineAPIRequest;
use App\Http\Requests\API\Inventory\UpdateStockMoveLineAPIRequest;
use App\Models\Inventory\StockMoveLine;
use App\Repositories\Inventory\StockMoveLineRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Inventory\StockMoveLineResource;
use Response;

/**
 * Class StockMoveLineController
 * @package App\Http\Controllers\API\Inventory
 */

class StockMoveLineAPIController extends AppBaseController
{
    /** @var  StockMoveLineRepository */
    private $stockMoveLineRepository;

    public function __construct(StockMoveLineRepository $stockMoveLineRepo)
    {
        $this->stockMoveLineRepository = $stockMoveLineRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/stockMoveLines",
     *      summary="Get a listing of the StockMoveLines.",
     *      tags={"StockMoveLine"},
     *      description="Get all StockMoveLines",
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
     *                  @SWG\Items(ref="#/definitions/StockMoveLine")
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
        $stockMoveLines = $this->stockMoveLineRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StockMoveLineResource::collection($stockMoveLines), 'Stock Move Lines retrieved successfully');
    }

    /**
     * @param CreateStockMoveLineAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/stockMoveLines",
     *      summary="Store a newly created StockMoveLine in storage",
     *      tags={"StockMoveLine"},
     *      description="Store StockMoveLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StockMoveLine that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StockMoveLine")
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
     *                  ref="#/definitions/StockMoveLine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStockMoveLineAPIRequest $request)
    {
        $input = $request->all();

        $stockMoveLine = $this->stockMoveLineRepository->create($input);

        return $this->sendResponse(new StockMoveLineResource($stockMoveLine), 'Stock Move Line saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/stockMoveLines/{id}",
     *      summary="Display the specified StockMoveLine",
     *      tags={"StockMoveLine"},
     *      description="Get StockMoveLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockMoveLine",
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
     *                  ref="#/definitions/StockMoveLine"
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
        /** @var StockMoveLine $stockMoveLine */
        $stockMoveLine = $this->stockMoveLineRepository->find($id);

        if (empty($stockMoveLine)) {
            return $this->sendError('Stock Move Line not found');
        }

        return $this->sendResponse(new StockMoveLineResource($stockMoveLine), 'Stock Move Line retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStockMoveLineAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/stockMoveLines/{id}",
     *      summary="Update the specified StockMoveLine in storage",
     *      tags={"StockMoveLine"},
     *      description="Update StockMoveLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockMoveLine",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StockMoveLine that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StockMoveLine")
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
     *                  ref="#/definitions/StockMoveLine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStockMoveLineAPIRequest $request)
    {
        $input = $request->all();

        /** @var StockMoveLine $stockMoveLine */
        $stockMoveLine = $this->stockMoveLineRepository->find($id);

        if (empty($stockMoveLine)) {
            return $this->sendError('Stock Move Line not found');
        }

        $stockMoveLine = $this->stockMoveLineRepository->update($input, $id);

        return $this->sendResponse(new StockMoveLineResource($stockMoveLine), 'StockMoveLine updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/stockMoveLines/{id}",
     *      summary="Remove the specified StockMoveLine from storage",
     *      tags={"StockMoveLine"},
     *      description="Delete StockMoveLine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockMoveLine",
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
        /** @var StockMoveLine $stockMoveLine */
        $stockMoveLine = $this->stockMoveLineRepository->find($id);

        if (empty($stockMoveLine)) {
            return $this->sendError('Stock Move Line not found');
        }

        $stockMoveLine->delete();

        return $this->sendSuccess('Stock Move Line deleted successfully');
    }
}
