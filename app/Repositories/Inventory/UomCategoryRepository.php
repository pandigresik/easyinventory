<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\UomCategory;
use App\Repositories\BaseRepository;

/**
 * Class UomCategoryRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 11:33 am WIB
*/

class UomCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return UomCategory::class;
    }
}
