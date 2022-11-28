<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StockAdjustment;
use App\Repositories\BaseRepository;

/**
 * Class StockAdjustmentRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class StockAdjustmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'number',
        'transaction_date',
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
        return StockAdjustment::class;
    }
}
