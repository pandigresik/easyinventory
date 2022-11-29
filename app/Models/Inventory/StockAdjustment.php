<?php

namespace App\Models\Inventory;

use Alfa6661\AutoNumber\AutoNumberTrait;
use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @SWG\Definition(
 *      definition="StockAdjustment",
 *      required={"number", "transaction_date", "description"},
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
class StockAdjustment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use AutoNumberTrait;

    public $table = 'stock_adjustments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'number',
        'transaction_date',
        'warehouse_id',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'number' => 'string',
        'transaction_date' => 'date',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        // 'number' => 'required|string|max:25',
        'transaction_date' => 'required',
        'description' => 'required|string',
        'warehouse_id' => 'required',
    ];

    /**
     * Get all of the stockAdjusmentLines for the StockAdjustment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stockAdjusmentLines(): HasMany
    {
        return $this->hasMany(StockAdjustmentLine::class, 'stock_adjustment_id');
    }

    public function getAutoNumberOptions()
    {
        return [
            'number' => [
                'format' => function () {
                    return 'ADJ/'. date('Ym') . '/?'; // autonumber format. '?' will be replaced with the generated number.
                },
                'length' => 5 // The number of digits in the autonumber
            ]
        ];
    }
    
}
