<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StorageLocation;
use App\Repositories\BaseRepository;

/**
 * Class StorageLocationRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class StorageLocationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'description',
        'warehouse_id',
        'parent_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return StorageLocation::class;
    }
}
