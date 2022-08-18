<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    protected $repository;
    protected $repositoryObj;

    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    public function sendSuccess($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message,
        ], 200);
    }

    /**
     * Get the value of repository.
     */
    public function getRepository()
    {
        return $this->repository;
    }

    public function getRepositoryObj()
    {
        return $this->repositoryObj ?? App::make($this->repository);
    }

    /**
     * Set the value of repository.
     *
     * @param mixed $repository
     *
     * @return self
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;

        return $this;
    }
}
