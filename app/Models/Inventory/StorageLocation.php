<?php

namespace App\Models\Inventory;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

/**
 * @SWG\Definition(
 *      definition="StorageLocation",
 *      required={"code", "name", "description", "warehouse_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      )
 * )
 */
class StorageLocation extends Model
{
    use HasFactory;
    use SoftDeletes;
    use NodeTrait;
    public $table = 'storage_locations';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'name',
        'description',
        'warehouse_id',
        'parent_id',
        '_lft',
        '_rgt'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'name' => 'string',
        'description' => 'string',
        'warehouse_id' => 'integer',
        'parent_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required|string|max:10',
        'name' => 'required|string|max:50',
        // 'description' => 'required|string',
        'warehouse_id' => 'required',
        'parent_id' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function warehouse()
    {
        return $this->belongsTo(\App\Models\Inventory\Warehouse::class, 'warehouse_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stockAdjustmentLines()
    {
        return $this->hasMany(\App\Models\Inventory\StockAdjustmentLine::class, 'storage_location_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stockMoveLines()
    {
        return $this->hasMany(\App\Models\Inventory\StockMoveLine::class, 'storage_location_id');
    }

    public function parentNode()
    {
        return $this->belongsTo(\App\Models\Inventory\StorageLocation::class, 'parent_id');
    }

    public function stockProducts()
    {
        return $this->hasMany(\App\Models\Inventory\StockProduct::class, 'storage_location_id');
    }
}
