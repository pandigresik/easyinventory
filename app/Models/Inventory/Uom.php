<?php

namespace App\Models\Inventory;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Uom",
 *      required={"name", "category_id", "factor", "uom_type_id", "uom_category_id"},
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
class Uom extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'uoms';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const UOM_TYPE = ['reference', 'bigger', 'smaller'];

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',        
        'factor',
        'rounding',
        'uom_type',
        'uom_category_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',        
        'factor' => 'float',
        'rounding' => 'float',
        'uom_type_id' => 'integer',
        'uom_category_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',        
        'factor' => 'required|numeric',
        'rounding' => 'nullable|numeric',        
        'uom_category_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function uomCategory()
    {
        return $this->belongsTo(\App\Models\Inventory\UomCategory::class, 'uom_category_id');
    }    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function products()
    {
        return $this->hasMany(\App\Models\Inventory\Product::class, 'uom_id');
    }
}
