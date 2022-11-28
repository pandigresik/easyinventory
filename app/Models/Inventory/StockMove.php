<?php

namespace App\Models\Inventory;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Alfa6661\AutoNumber\AutoNumberTrait;

/**
 * @SWG\Definition(
 *      definition="StockMove",
 *      required={"transaction_date", "number", "warehouse_id", "stock_move_type"},
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
    use AutoNumberTrait;

    public $table = 'stock_moves';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    protected $moveType = 'IN';


    public $fillable = [
        'transaction_date',
        'number',
        'references',
        'responsbility',
        'warehouse_id',
        'stock_move_type'
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
        'stock_move_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'transaction_date' => 'required',
    //    'number' => 'required|string|max:25',
        'references' => 'nullable|string|max:50',
        'responsbility' => 'nullable|string|max:50',
        'warehouse_id' => 'required',
    //    'stock_move_type_id' => 'required'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'number' => [
                'format' => function () {
                    return 'WH/'.$this->stock_move_type.'/'. date('Ymd') . '/?'; // autonumber format. '?' will be replaced with the generated number.
                },
                'length' => 5 // The number of digits in the autonumber
            ]
        ];
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

    public function getTransactionDateAttribute($value){
        return localFormatDate($value);
    }
    /**
     * Get the value of moveType
     */ 
    public function getMoveType()
    {
        return $this->moveType;
    }

    /**
     * Set the value of moveType
     *
     * @return  self
     */ 
    public function setMoveType($moveType)
    {
        $this->moveType = $moveType;

        return $this;
    }
}
