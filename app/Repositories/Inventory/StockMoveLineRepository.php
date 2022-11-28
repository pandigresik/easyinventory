<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StockMoveLine;
use App\Repositories\BaseRepository;

/**
 * Class StockMoveLineRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class StockMoveLineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'stock_move_id',
        'product_id',
        'storage_location_id',
        'quantity',
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
        return StockMoveLine::class;
    }
}
