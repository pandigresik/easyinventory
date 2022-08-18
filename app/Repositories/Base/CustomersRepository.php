<?php

namespace App\Repositories\Base;

use App\Models\Base\Customers;
use App\Repositories\BaseRepository;

/**
 * Class CustomersRepository
 * @package App\Repositories\Base
 * @version April 28, 2022, 1:51 pm WIB
*/

class CustomersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'address',
        'user_id'
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
        return Customers::class;
    }
}
