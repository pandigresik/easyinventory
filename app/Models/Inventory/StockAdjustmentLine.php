<?php

namespace App\Models\Inventory;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="StockAdjustmentLine",
 *      required={"product_id", "storage_location_id", "count_quantity", "onhand_quantity", "transaction_date", "state"},
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
class StockAdjustmentLine extends Model
{
    use HasFactory;
        use SoftDeletes;

    public $table = 'stock_adjustment_lines';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'product_id',
        'storage_location_id',
        'count_quantity',
        'onhand_quantity',
        'transaction_date',
        'description',
        'state'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'storage_location_id' => 'integer',
        'count_quantity' => 'integer',
        'onhand_quantity' => 'integer',
        'transaction_date' => 'date',
        'description' => 'string',
        'state' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required',
        'storage_location_id' => 'required',
        'count_quantity' => 'required|integer',
        'onhand_quantity' => 'required|integer',
        'transaction_date' => 'required',
        'description' => 'nullable|string',
        'state' => 'required|string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(\App\Models\Inventory\Product::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function storageLocation()
    {
        return $this->belongsTo(\App\Models\Inventory\StorageLocation::class, 'storage_location_id');
    }
}
