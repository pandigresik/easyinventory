<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StockProduct;
use App\Repositories\BaseRepository;

/**
 * Class StockProductRepository
 * @package App\Repositories\Inventory
 * @version November 29, 2022, 8:40 am WIB
*/

class StockProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id',
        'storage_location_id',
        'quantity'
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
        return StockProduct::class;
    }
}
