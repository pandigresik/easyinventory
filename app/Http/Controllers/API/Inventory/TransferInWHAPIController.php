<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateStockMoveAPIRequest;
use App\Http\Requests\API\Inventory\UpdateStockMoveAPIRequest;
use App\Models\Inventory\StockMove;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Inventory\StockMoveResource;
use App\Models\Inventory\StockMoveLine;
use App\Repositories\Inventory\TransferInWHRepository;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class StockMoveController
 * @package App\Http\Controllers\API\Inventory
 */

class TransferInWHAPIController extends AppBaseController
{
    /** @var  TransferInWHRepository */
    private $transferInWHRepository;

    public function __construct(TransferInWHRepository $transferInWHRepository)
    {
        $this->transferInWHRepository = $transferInWHRepository;
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
        $stockMoves = $this->transferInWHRepository->all(
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

        $stockMove = $this->transferInWHRepository->create($input);

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
        $stockMove = $this->transferInWHRepository->find($id);

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
        $stockMove = $this->transferInWHRepository->find($id);

        if (empty($stockMove)) {
            return $this->sendError('Stock Move not found');
        }

        $stockMove = $this->transferInWHRepository->update($input, $id);

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
        $stockMove = $this->transferInWHRepository->find($id);

        if (empty($stockMove)) {
            return $this->sendError('Stock Move not found');
        }

        $stockMove->delete();

        return $this->sendSuccess('Stock Move deleted successfully');
    }

    /** get list product send to currentWarehouse from originWarehouse */
    public function getListTransferProduct(){        
        $currentWarehouse = request()->get('currentWarehouse');
        $originWarehouse = request()->get('originWarehouse');
        if(empty($currentWarehouse)){
            throw ValidationException::withMessages([
                'currentWarehouse' => 'Current Warehouse is required'
            ]);
        }

        if(empty($originWarehouse)){
            throw ValidationException::withMessages([
                'originWarehouse' => 'Origin Warehouse is required'
            ]);
        }
        $withProduct = true;
        $detail = (new StockMoveLine())->listTransferInWH($currentWarehouse, $originWarehouse, $withProduct);
        return $this->sendResponse($detail, 'success');
    }
}
