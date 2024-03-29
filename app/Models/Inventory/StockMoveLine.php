<?php

namespace App\Models\Inventory;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="StockMoveLine",
 *      required={"stock_move_id", "product_id", "storage_location_id", "quantity"},
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
class StockMoveLine extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'stock_move_lines';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'stock_move_id',
        'product_id',
        'storage_location_id',
        'quantity',
        'balance',
        'lot_number',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'stock_move_id' => 'integer',
        'product_id' => 'integer',
        'storage_location_id' => 'integer',
        'quantity' => 'integer',
        'lot_number' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'stock_move_id' => 'required',
        'product_id' => 'required',
        'storage_location_id' => 'required',
        'quantity' => 'required|integer',
        'description' => 'nullable|string|max:80'
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
    public function stockMove()
    {
        return $this->belongsTo(\App\Models\Inventory\StockMove::class, 'stock_move_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function storageLocation()
    {
        return $this->belongsTo(\App\Models\Inventory\StorageLocation::class, 'storage_location_id');
    }

    public function listTransferInWH($currentWarehouse, $originWarehouse, $withProduct = false){
        $query = $this->selectRaw('sum(quantity) as quantity, product_id')->disableModelCaching()->whereHas('stockMove', function($q) use ($currentWarehouse, $originWarehouse) { 
            return $q->where(['warehouse_id' => $currentWarehouse, 'stock_move_type' => 'TMP_TR_OUT'])
                ->whereIn('references', function($r) use ($originWarehouse) {
                    return $r->select(['number'])
                            ->from('stock_moves')
                            ->where(['warehouse_id' => $originWarehouse, 'stock_move_type' => 'TR_OUT']);
                })
                // ->whereRaw('`references` in (select number from stock_moves where warehouse_id = '.$originWarehouse.' and stock_move_type = \'TR_OUT\')')
                ;
        })->where('quantity','>', 0)
        ->groupBy(['product_id']);
        if($withProduct){
            $query->with(['product']);
        }
        return $query->get()->toArray();
    }
}
