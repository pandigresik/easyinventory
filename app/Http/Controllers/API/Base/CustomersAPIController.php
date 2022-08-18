<?php

namespace App\Http\Controllers\API\Base;

use App\Http\Requests\API\Base\CreateCustomersAPIRequest;
use App\Http\Requests\API\Base\UpdateCustomersAPIRequest;
use App\Models\Base\Customers;
use App\Repositories\Base\CustomersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Base\CustomersResource;
use Response;

/**
 * Class CustomersController
 * @package App\Http\Controllers\API\Base
 */

class CustomersAPIController extends AppBaseController
{
    /** @var  CustomersRepository */
    private $customersRepository;

    public function __construct(CustomersRepository $customersRepo)
    {
        $this->customersRepository = $customersRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/customers",
     *      summary="Get a listing of the Customers.",
     *      tags={"Customers"},
     *      description="Get all Customers",
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
     *                  @SWG\Items(ref="#/definitions/Customers")
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
        $customers = $this->customersRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(CustomersResource::collection($customers), 'Customers retrieved successfully');
    }

    /**
     * @param CreateCustomersAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/customers",
     *      summary="Store a newly created Customers in storage",
     *      tags={"Customers"},
     *      description="Store Customers",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Customers that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Customers")
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
     *                  ref="#/definitions/Customers"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCustomersAPIRequest $request)
    {
        $input = $request->all();

        $customers = $this->customersRepository->create($input);

        return $this->sendResponse(new CustomersResource($customers), 'Customers saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/customers/{id}",
     *      summary="Display the specified Customers",
     *      tags={"Customers"},
     *      description="Get Customers",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Customers",
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
     *                  ref="#/definitions/Customers"
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
        /** @var Customers $customers */
        $customers = $this->customersRepository->find($id);

        if (empty($customers)) {
            return $this->sendError('Customers not found');
        }

        return $this->sendResponse(new CustomersResource($customers), 'Customers retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCustomersAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/customers/{id}",
     *      summary="Update the specified Customers in storage",
     *      tags={"Customers"},
     *      description="Update Customers",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Customers",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Customers that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Customers")
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
     *                  ref="#/definitions/Customers"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCustomersAPIRequest $request)
    {
        $input = $request->all();

        /** @var Customers $customers */
        $customers = $this->customersRepository->find($id);

        if (empty($customers)) {
            return $this->sendError('Customers not found');
        }

        $customers = $this->customersRepository->update($input, $id);

        return $this->sendResponse(new CustomersResource($customers), 'Customers updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/customers/{id}",
     *      summary="Remove the specified Customers from storage",
     *      tags={"Customers"},
     *      description="Delete Customers",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Customers",
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
        /** @var Customers $customers */
        $customers = $this->customersRepository->find($id);

        if (empty($customers)) {
            return $this->sendError('Customers not found');
        }

        $customers->delete();

        return $this->sendSuccess('Customers deleted successfully');
    }
}
