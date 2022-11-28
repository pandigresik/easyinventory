<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateProductCategoryAPIRequest;
use App\Http\Requests\API\Inventory\UpdateProductCategoryAPIRequest;
use App\Models\Inventory\ProductCategory;
use App\Repositories\Inventory\ProductCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Inventory\ProductCategoryResource;
use Response;

/**
 * Class ProductCategoryController
 * @package App\Http\Controllers\API\Inventory
 */

class ProductCategoryAPIController extends AppBaseController
{
    /** @var  ProductCategoryRepository */
    private $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepo)
    {
        $this->productCategoryRepository = $productCategoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/productCategories",
     *      summary="Get a listing of the ProductCategories.",
     *      tags={"ProductCategory"},
     *      description="Get all ProductCategories",
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
     *                  @SWG\Items(ref="#/definitions/ProductCategory")
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
        $productCategories = $this->productCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ProductCategoryResource::collection($productCategories), 'Product Categories retrieved successfully');
    }

    /**
     * @param CreateProductCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/productCategories",
     *      summary="Store a newly created ProductCategory in storage",
     *      tags={"ProductCategory"},
     *      description="Store ProductCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ProductCategory that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductCategory")
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
     *                  ref="#/definitions/ProductCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProductCategoryAPIRequest $request)
    {
        $input = $request->all();

        $productCategory = $this->productCategoryRepository->create($input);

        return $this->sendResponse(new ProductCategoryResource($productCategory), 'Product Category saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/productCategories/{id}",
     *      summary="Display the specified ProductCategory",
     *      tags={"ProductCategory"},
     *      description="Get ProductCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProductCategory",
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
     *                  ref="#/definitions/ProductCategory"
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
        /** @var ProductCategory $productCategory */
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            return $this->sendError('Product Category not found');
        }

        return $this->sendResponse(new ProductCategoryResource($productCategory), 'Product Category retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateProductCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/productCategories/{id}",
     *      summary="Update the specified ProductCategory in storage",
     *      tags={"ProductCategory"},
     *      description="Update ProductCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProductCategory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ProductCategory that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ProductCategory")
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
     *                  ref="#/definitions/ProductCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProductCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductCategory $productCategory */
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            return $this->sendError('Product Category not found');
        }

        $productCategory = $this->productCategoryRepository->update($input, $id);

        return $this->sendResponse(new ProductCategoryResource($productCategory), 'ProductCategory updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/productCategories/{id}",
     *      summary="Remove the specified ProductCategory from storage",
     *      tags={"ProductCategory"},
     *      description="Delete ProductCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ProductCategory",
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
        /** @var ProductCategory $productCategory */
        $productCategory = $this->productCategoryRepository->find($id);

        if (empty($productCategory)) {
            return $this->sendError('Product Category not found');
        }

        $productCategory->delete();

        return $this->sendSuccess('Product Category deleted successfully');
    }
}
