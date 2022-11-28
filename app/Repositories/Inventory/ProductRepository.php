<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\Product;
use App\Repositories\BaseRepository;

/**
 * Class ProductRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'description',
        'product_category_id',
        'uom_id'
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
        return Product::class;
    }
}
