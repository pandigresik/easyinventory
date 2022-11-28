<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StockAdjustmentLine;
use App\Repositories\BaseRepository;

/**
 * Class StockAdjustmentLineRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class StockAdjustmentLineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'storage_location_id',
        'count_quantity',
        'onhand_quantity',
        'transaction_date',
        'description',
        'state'
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
        return StockAdjustmentLine::class;
    }
}
