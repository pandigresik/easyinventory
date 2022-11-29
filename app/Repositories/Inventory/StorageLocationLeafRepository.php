<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StorageLocation;

/**
 * Class StorageLocationRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class StorageLocationLeafRepository extends StorageLocationRepository
{
    public function pluck($search = [], $skip = null, $limit = null, $key = null, $value = null)
    {
        $key = $key ?? $this->model->getKeyName();
        $value = $value ?? $this->model->getShowColumnOption();
        $query = $this->allQuery($search, $skip, $limit);
        $query->whereIsLeaf();
        return $query->pluck($value, $key)->toArray();
    }
}
