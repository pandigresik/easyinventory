<?php

namespace App\Repositories\Base;

use App\Models\Base\Permission;
use App\Repositories\BaseRepository;

/**
 * Class PermissionRepository.
 *
 * @version May 17, 2021, 3:50 am UTC
 */
class PermissionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'guard_name',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     */
    public function model()
    {
        return Permission::class;
    }
}
