<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StockAdjustment;
use App\Models\Inventory\StockMove;
use App\Models\Inventory\StockMoveLine;
use App\Models\Inventory\StockProduct;
use App\Repositories\BaseRepository;

/**
 * Class StockAdjustmentRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class StockAdjustmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'number',
        'transaction_date',
        'description'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return StockAdjustment::class;
    }
    public function create($input)
    {
        $this->model->getConnection()->beginTransaction();

        try {
            $detail = $input['stock_adjustment_line'];            
            
            $model = $this->model->newInstance($input);                      
            $model->save();
            $this->setDetails($detail, $model);
            $this->generateStockMovement($detail, $model);
            $this->model->getConnection()->commit();

            return $model;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $this->model->getConnection()->rollBack();

            return $e;
        }
    }

    public function update($input, $id)
    {
        return true;
    }

    private function setDetails($detail, $model)
    {        
        if (!empty($detail)) {
            foreach ($detail['product_id'] as $key => $item) {
                $onhandQty = $detail['onhand_quantity'][$key] ?? 0;
                $productId = $detail['product_id'][$key];
                $storageLocationId = $detail['storage_location_id'][$key];
                $model->stockAdjusmentLines()->create([
                    'product_id' => $productId,
                    'storage_location_id' => $storageLocationId,
                    'description' => $detail['description'][$key] ?? null,
                    'count_quantity' => $detail['count_quantity'][$key] ?? 0,
                    'onhand_quantity' => $onhandQty,
                    'transaction_date' => $model->getRawOriginal('transaction_date')
                ]);

                $stock = StockProduct::firstOrCreate(['product_id' => $productId, 'storage_location_id' => $storageLocationId]);
                $stock->quantity = $onhandQty;
                $stock->save();                
            }
        }
    }

    private function generateStockMovement($detail, $model)
    {        
        if (!empty($detail)) {
            $moveLineIn = [];
            $moveLineOut = [];
            foreach ($detail['product_id'] as $key => $item) {
                $onhandQty = 0;
                if($detail['onhand_quantity'][$key]){
                    if(empty($detail['onhand_quantity'][$key])){
                        $onhandQty = 0;
                    }
                }
                $qty = $detail['count_quantity'][$key] ?? 0;
                $productId = $detail['product_id'][$key];
                $storageLocationId = $detail['storage_location_id'][$key];
                $diffQty = $onhandQty - $qty;
                if($diffQty > 0){
                    $moveLineIn[] = [
                        'product_id' => $productId,
                        'storage_location_id' => $storageLocationId,
                        'description' => $detail['description'][$key] ?? null,
                        'quantity' => abs($diffQty),
                        'balance' => $diffQty                    
                    ];
                }

                if($diffQty < 0){
                    $moveLineOut[] = [
                        'product_id' => $productId,
                        'storage_location_id' => $storageLocationId,
                        'description' => $detail['description'][$key] ?? null,
                        'quantity' => abs($diffQty),
                        'balance' => -1 * $diffQty                        
                    ];
                }                
            }
            if($moveLineIn){
                $stockMove = StockMove::create([
                    'warehouse_id' => $model->warehouse_id,
                    'transaction_date' => $model->getRawOriginal('transaction_date'),                    
                    'references' => $model->number,
                    'responsbility' => 'system',                    
                    'stock_move_type' => 'ADJ_IN'
                ]);
                $stockMove->stockMoveLines()->createMany($moveLineIn);
            }

            if($moveLineOut){
                $stockMove = StockMove::create([
                    'warehouse_id' => $model->warehouse_id,
                    'transaction_date' => $model->getRawOriginal('transaction_date'),                    
                    'references' => $model->number,
                    'responsbility' => 'system',                    
                    'stock_move_type' => 'ADJ_OUT'
                ]);
                $stockMove->stockMoveLines()->createMany($moveLineOut);
            }
        }
    }
    
    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return null|bool|mixed
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();
        $model = $query->findOrFail($id);
        $model->stockAdjusmentLines()->delete();
        return $model->delete();
    }    
}

