<?php

namespace App\Http\Controllers\API\Inventory;

use App\Http\Requests\API\Inventory\CreateWarehouseAPIRequest;
use App\Http\Requests\API\Inventory\UpdateWarehouseAPIRequest;
use App\Models\Inventory\Warehouse;
use App\Repositories\Inventory\WarehouseRepository;
use Illuminate\Http\Request;
use App\Http\Resources\Inventory\WarehouseResource;
use App\Repositories\Inventory\WarehouseUserRepository;
use Response;

/**
 * Class WarehouseController
 * @package App\Http\Controllers\API\Inventory
 */

class WarehouseUserAPIController extends WarehouseAPIController
{
    /** @var  WarehouseRepository */
    protected $warehouseRepository;

    public function __construct(WarehouseUserRepository $warehouseRepo)
    {
        $this->warehouseRepository = $warehouseRepo;
    }    
}
