<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateUomCategoryAPIRequest;
use App\Http\Requests\API\Inventory\UpdateUomCategoryAPIRequest;
use App\Models\Inventory\UomCategory;
use App\Repositories\Inventory\UomCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Inventory\UomCategoryResource;
use Response;

/**
 * Class UomCategoryController
 * @package App\Http\Controllers\API\Inventory
 */

class UomCategoryAPIController extends AppBaseController
{
    /** @var  UomCategoryRepository */
    private $uomCategoryRepository;

    public function __construct(UomCategoryRepository $uomCategoryRepo)
    {
        $this->uomCategoryRepository = $uomCategoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/uomCategories",
     *      summary="Get a listing of the UomCategories.",
     *      tags={"UomCategory"},
     *      description="Get all UomCategories",
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
     *                  @SWG\Items(ref="#/definitions/UomCategory")
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
        $uomCategories = $this->uomCategoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(UomCategoryResource::collection($uomCategories), 'Uom Categories retrieved successfully');
    }

    /**
     * @param CreateUomCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/uomCategories",
     *      summary="Store a newly created UomCategory in storage",
     *      tags={"UomCategory"},
     *      description="Store UomCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UomCategory that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UomCategory")
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
     *                  ref="#/definitions/UomCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUomCategoryAPIRequest $request)
    {
        $input = $request->all();

        $uomCategory = $this->uomCategoryRepository->create($input);

        return $this->sendResponse(new UomCategoryResource($uomCategory), 'Uom Category saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/uomCategories/{id}",
     *      summary="Display the specified UomCategory",
     *      tags={"UomCategory"},
     *      description="Get UomCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UomCategory",
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
     *                  ref="#/definitions/UomCategory"
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
        /** @var UomCategory $uomCategory */
        $uomCategory = $this->uomCategoryRepository->find($id);

        if (empty($uomCategory)) {
            return $this->sendError('Uom Category not found');
        }

        return $this->sendResponse(new UomCategoryResource($uomCategory), 'Uom Category retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUomCategoryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/uomCategories/{id}",
     *      summary="Update the specified UomCategory in storage",
     *      tags={"UomCategory"},
     *      description="Update UomCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UomCategory",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UomCategory that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UomCategory")
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
     *                  ref="#/definitions/UomCategory"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUomCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var UomCategory $uomCategory */
        $uomCategory = $this->uomCategoryRepository->find($id);

        if (empty($uomCategory)) {
            return $this->sendError('Uom Category not found');
        }

        $uomCategory = $this->uomCategoryRepository->update($input, $id);

        return $this->sendResponse(new UomCategoryResource($uomCategory), 'UomCategory updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/uomCategories/{id}",
     *      summary="Remove the specified UomCategory from storage",
     *      tags={"UomCategory"},
     *      description="Delete UomCategory",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UomCategory",
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
        /** @var UomCategory $uomCategory */
        $uomCategory = $this->uomCategoryRepository->find($id);

        if (empty($uomCategory)) {
            return $this->sendError('Uom Category not found');
        }

        $uomCategory->delete();

        return $this->sendSuccess('Uom Category deleted successfully');
    }
}
