<?php

namespace App\Models\Inventory;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Product",
 *      required={"code", "name", "description", "product_category_id", "uom_id"},
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
class Product extends Model
{
    use HasFactory;
        use SoftDeletes;

    public $table = 'products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'name',
        'description',
        'product_category_id',
        'uom_id'
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
        'product_category_id' => 'integer',
        'uom_id' => 'integer'
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
        'product_category_id' => 'required',
        'uom_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function productCategory()
    {
        return $this->belongsTo(\App\Models\Inventory\ProductCategory::class, 'product_category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function uom()
    {
        return $this->belongsTo(\App\Models\Inventory\Uom::class, 'uom_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stockAdjustmentLines()
    {
        return $this->hasMany(\App\Models\Inventory\StockAdjustmentLine::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stockMoveLines()
    {
        return $this->hasMany(\App\Models\Inventory\StockMoveLine::class, 'product_id');
    }
}
