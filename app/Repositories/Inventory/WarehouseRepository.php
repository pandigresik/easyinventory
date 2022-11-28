<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\Warehouse;
use App\Repositories\BaseRepository;

/**
 * Class WarehouseRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class WarehouseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'description'
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
        return Warehouse::class;
    }
}
