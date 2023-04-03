<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\Warehouse;

/**
 * Class WarehouseRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class WarehouseUserRepository extends WarehouseRepository
{
    public function allQuery($search = [], $skip = null, $limit = null){
        $query = parent::allQuery($search, $skip, $limit);
        return $query->canAccess();
    }
}
