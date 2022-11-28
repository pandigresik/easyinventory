<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\Uom;
use App\Repositories\BaseRepository;

/**
 * Class UomRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class UomRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'category_id',
        'factor',
        'rounding',
        'uom_type_id',
        'uom_category_id'
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
        return Uom::class;
    }
}
