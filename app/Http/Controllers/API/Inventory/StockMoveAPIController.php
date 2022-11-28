<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateStockMoveAPIRequest;
use App\Http\Requests\API\Inventory\UpdateStockMoveAPIRequest;
use App\Models\Inventory\StockMove;
use App\Repositories\Inventory\StockMoveRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Inventory\StockMoveResource;
use Response;

/**
 * Class StockMoveController
 * @package App\Http\Controllers\API\Inventory
 */

class StockMoveAPIController extends AppBaseController
{
    /** @var  StockMoveRepository */
    private $stockMoveRepository;

    public function __construct(StockMoveRepository $stockMoveRepo)
    {
        $this->stockMoveRepository = $stockMoveRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/stockMoves",
     *      summary="Get a listing of the StockMoves.",
     *      tags={"StockMove"},
     *      description="Get all StockMoves",
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
     *                  @SWG\Items(ref="#/definitions/StockMove")
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
        $stockMoves = $this->stockMoveRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StockMoveResource::collection($stockMoves), 'Stock Moves retrieved successfully');
    }

    /**
     * @param CreateStockMoveAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/stockMoves",
     *      summary="Store a newly created StockMove in storage",
     *      tags={"StockMove"},
     *      description="Store StockMove",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StockMove that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StockMove")
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
     *                  ref="#/definitions/StockMove"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStockMoveAPIRequest $request)
    {
        $input = $request->all();

        $stockMove = $this->stockMoveRepository->create($input);

        return $this->sendResponse(new StockMoveResource($stockMove), 'Stock Move saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/stockMoves/{id}",
     *      summary="Display the specified StockMove",
     *      tags={"StockMove"},
     *      description="Get StockMove",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockMove",
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
     *                  ref="#/definitions/StockMove"
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
        /** @var StockMove $stockMove */
        $stockMove = $this->stockMoveRepository->find($id);

        if (empty($stockMove)) {
            return $this->sendError('Stock Move not found');
        }

        return $this->sendResponse(new StockMoveResource($stockMove), 'Stock Move retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStockMoveAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/stockMoves/{id}",
     *      summary="Update the specified StockMove in storage",
     *      tags={"StockMove"},
     *      description="Update StockMove",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockMove",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StockMove that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StockMove")
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
     *                  ref="#/definitions/StockMove"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStockMoveAPIRequest $request)
    {
        $input = $request->all();

        /** @var StockMove $stockMove */
        $stockMove = $this->stockMoveRepository->find($id);

        if (empty($stockMove)) {
            return $this->sendError('Stock Move not found');
        }

        $stockMove = $this->stockMoveRepository->update($input, $id);

        return $this->sendResponse(new StockMoveResource($stockMove), 'StockMove updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/stockMoves/{id}",
     *      summary="Remove the specified StockMove from storage",
     *      tags={"StockMove"},
     *      description="Delete StockMove",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockMove",
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
        /** @var StockMove $stockMove */
        $stockMove = $this->stockMoveRepository->find($id);

        if (empty($stockMove)) {
            return $this->sendError('Stock Move not found');
        }

        $stockMove->delete();

        return $this->sendSuccess('Stock Move deleted successfully');
    }
}
