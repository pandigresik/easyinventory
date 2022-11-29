<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateStockProductAPIRequest;
use App\Http\Requests\API\Inventory\UpdateStockProductAPIRequest;
use App\Models\Inventory\StockProduct;
use App\Repositories\Inventory\StockProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Inventory\StockProductResource;
use Response;

/**
 * Class StockProductController
 * @package App\Http\Controllers\API\Inventory
 */

class StockProductAPIController extends AppBaseController
{
    /** @var  StockProductRepository */
    private $stockProductRepository;

    public function __construct(StockProductRepository $stockProductRepo)
    {
        $this->stockProductRepository = $stockProductRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/stockProducts",
     *      summary="Get a listing of the StockProducts.",
     *      tags={"StockProduct"},
     *      description="Get all StockProducts",
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
     *                  @SWG\Items(ref="#/definitions/StockProduct")
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
        $stockProducts = $this->stockProductRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StockProductResource::collection($stockProducts), 'Stock Products retrieved successfully');
    }

    /**
     * @param CreateStockProductAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/stockProducts",
     *      summary="Store a newly created StockProduct in storage",
     *      tags={"StockProduct"},
     *      description="Store StockProduct",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StockProduct that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StockProduct")
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
     *                  ref="#/definitions/StockProduct"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStockProductAPIRequest $request)
    {
        $input = $request->all();

        $stockProduct = $this->stockProductRepository->create($input);

        return $this->sendResponse(new StockProductResource($stockProduct), 'Stock Product saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/stockProducts/{id}",
     *      summary="Display the specified StockProduct",
     *      tags={"StockProduct"},
     *      description="Get StockProduct",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockProduct",
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
     *                  ref="#/definitions/StockProduct"
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
        /** @var StockProduct $stockProduct */
        $stockProduct = $this->stockProductRepository->find($id);

        if (empty($stockProduct)) {
            return $this->sendError('Stock Product not found');
        }

        return $this->sendResponse(new StockProductResource($stockProduct), 'Stock Product retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStockProductAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/stockProducts/{id}",
     *      summary="Update the specified StockProduct in storage",
     *      tags={"StockProduct"},
     *      description="Update StockProduct",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockProduct",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StockProduct that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StockProduct")
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
     *                  ref="#/definitions/StockProduct"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStockProductAPIRequest $request)
    {
        $input = $request->all();

        /** @var StockProduct $stockProduct */
        $stockProduct = $this->stockProductRepository->find($id);

        if (empty($stockProduct)) {
            return $this->sendError('Stock Product not found');
        }

        $stockProduct = $this->stockProductRepository->update($input, $id);

        return $this->sendResponse(new StockProductResource($stockProduct), 'StockProduct updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/stockProducts/{id}",
     *      summary="Remove the specified StockProduct from storage",
     *      tags={"StockProduct"},
     *      description="Delete StockProduct",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StockProduct",
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
        /** @var StockProduct $stockProduct */
        $stockProduct = $this->stockProductRepository->find($id);

        if (empty($stockProduct)) {
            return $this->sendError('Stock Product not found');
        }

        $stockProduct->delete();

        return $this->sendSuccess('Stock Product deleted successfully');
    }
}
