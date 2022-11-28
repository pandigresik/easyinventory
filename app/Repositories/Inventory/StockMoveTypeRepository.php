<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StockMoveType;
use App\Repositories\BaseRepository;

/**
 * Class StockMoveTypeRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class StockMoveTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'sign_value',
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
        return StockMoveType::class;
    }
}
