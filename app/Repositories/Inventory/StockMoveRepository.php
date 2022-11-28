<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StockMove;
use App\Repositories\BaseRepository;

/**
 * Class StockMoveRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class StockMoveRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'transaction_date',
        'number',
        'references',
        'responsbility',
        'warehouse_id',
        'stock_move_type_id'
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
        return StockMove::class;
    }
}
