<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\UomType;
use App\Repositories\BaseRepository;

/**
 * Class UomTypeRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class UomTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name'
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
        return UomType::class;
    }
}
