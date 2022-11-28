<?php

namespace App\Models\Inventory;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="StockMove",
 *      required={"transaction_date", "number", "warehouse_id", "stock_move_type_id"},
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
class StockMove extends Model
{
    use HasFactory;
        use SoftDeletes;

    public $table = 'stock_moves';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'transaction_date',
        'number',
        'references',
        'responsbility',
        'warehouse_id',
        'stock_move_type_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'transaction_date' => 'date',
        'number' => 'string',
        'references' => 'string',
        'responsbility' => 'string',
        'warehouse_id' => 'integer',
        'stock_move_type_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'transaction_date' => 'required',
        'number' => 'required|string|max:25',
        'references' => 'nullable|string|max:50',
        'responsbility' => 'nullable|string|max:50',
        'warehouse_id' => 'required',
        'stock_move_type_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function stockMoveType()
    {
        return $this->belongsTo(\App\Models\Inventory\StockMoveType::class, 'stock_move_type_id');
    }

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
    public function stockMoveLines()
    {
        return $this->hasMany(\App\Models\Inventory\StockMoveLine::class, 'stock_move_id');
    }
}
