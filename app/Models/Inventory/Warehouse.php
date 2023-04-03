<?php

namespace App\Models\Inventory;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Warehouse",
 *      required={"code", "name", "description"},
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
class Warehouse extends Model
{
    use HasFactory;
        use SoftDeletes;

    public $table = 'warehouses';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'name',
        'description'
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
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required|string|max:10',
        'name' => 'required|string|max:50',
        'description' => 'required|string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stockMoves()
    {
        return $this->hasMany(\App\Models\Inventory\StockMove::class, 'warehouse_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function storageLocations()
    {
        return $this->hasMany(\App\Models\Inventory\StorageLocation::class, 'warehouse_id');
    }

    public function scopeCanAccess($query){
        $userWarehouse = UserWarehouse::where(['user_id' => auth()->id()])->get()->pluck('warehouse_id','warehouse_id')->toArray();
        return $query->whereIn('id', $userWarehouse);
    }
}
