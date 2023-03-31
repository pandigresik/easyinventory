<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\Product;
use App\Models\Inventory\StockMove;
use App\Models\Inventory\StockProduct;
use App\Repositories\BaseRepository;
use Exception;

/**
 * Class StockMoveRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class StockMoveRepository extends BaseRepository
{    
    protected $moveType = 'IN';
    protected $factorValue = ['IN' => 1, 'OUT' => '-1', 'ADJ_IN' => 1, 'ADJ_OUT' => -1, 'TR_IN' => 1, 'TR_OUT' => -1];
    private $updateStockProduct = 1;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'transaction_date',
        'number',
        'references',
        'responsbility',
        'warehouse_id',
        'lot_number',
        'stock_move_type'
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
        return StockMove::class;
    }

    public function create($input)
    {
        $this->model->getConnection()->beginTransaction();

        try {
            $detail = $input['stock_move_line'];
            if(in_array($this->moveType,['OUT', 'TR_OUT'])){
                // check stock product di storage location
                $this->checkStockProduct($detail);
            }
            
            $model = $this->model->newInstance($input);
            $model->stock_move_type = $this->moveType;
            $model->save();
            $this->setDetails($detail, $model);

            if(in_array($this->moveType,['TR_OUT'])){
                // create references move document                
                $this->updateStockProduct = 0;
                $refModel = $this->model->newInstance($input);
                $refModel->stock_move_type = 'TMP_'.$this->moveType;
                $refModel->references = $model->number;
                $refModel->warehouse_id = $input['warehouse_destination_id'];
                $refModel->save();
                $this->setDetails($detail, $refModel);  
            }
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
        $this->model->getConnection()->beginTransaction();

        try {
            $detail = $input['stock_move_line'];
            $input['stock_move_type'] = $this->moveType;            
            $model = parent::update($input, $id);
            $this->updateStockBeforeUpdate($model);
            $this->setDetails($detail, $model, 'UPDATE');

            if(in_array($this->moveType,['TR_OUT'])){
                // create references move document                
                $this->updateStockProduct = 0;
                $refModel = $this->model->newQuery()->where(['references' => $model->number, 'stock_move_type' => 'TMP_'.$this->moveType])->firstOrNew();
                $refModel->warehouse_id = $input['warehouse_destination_id'];
                $refModel->references = $model->number;
                $refModel->save(); 
                $this->setDetails($detail, $refModel);  
            }

            $this->model->getConnection()->commit();

            return $model;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $this->model->getConnection()->rollBack();

            return $e;
        }
    }

    protected function setDetails($detail, $model, $operation = 'INSERT')
    {        
        $model->stockMoveLines()->forceDelete();
        if (!empty($detail)) {
            foreach ($detail['product_id'] as $key => $item) {
                $balance = $this->factorValue[$this->moveType] * ($detail['quantity'][$key] ?? 0);
                $productId = $detail['product_id'][$key];
                $storageLocationId = $detail['storage_location_id'][$key];
                $model->stockMoveLines()->create([
                    'product_id' => $productId,
                    'storage_location_id' => $storageLocationId,
                    'description' => $detail['description'][$key] ?? null,
                    'quantity' => $detail['quantity'][$key] ?? 0,
                    'balance' => $balance,
                    'lot_number' => $detail['lot_number'][$key] ?? null,
                ]);

                if($this->updateStockProduct){
                    $stock = StockProduct::firstOrCreate(['product_id' => $productId, 'storage_location_id' => $storageLocationId]);
                    $stock->quantity += $balance;
                    $stock->save();
                }                
            }
        }
    }
    protected function updateStockBeforeUpdate($model){
        $details = $model->stockMoveLines;
        foreach($details as $item){            
            $stock = StockProduct::where(['product_id' => $item->product_id, 'storage_location_id' => $item->storage_location_id])->first();
            $stock->quantity += (-1 * $this->factorValue[$this->moveType] * $item->getRawOriginal('quantity'));
            $stock->save();                        
        }
    }
    
    protected function checkStockProduct($detail){
        foreach ($detail['product_id'] as $key => $item) {
            $quantity = $detail['quantity'][$key] ?? 0;
            $productId = $detail['product_id'][$key];
            $storageLocationId = $detail['storage_location_id'][$key];

            $stock = StockProduct::where(['product_id' => $productId, 'storage_location_id' => $storageLocationId])->first();
            if($stock){
                $stockQuantity = $stock->getRawOriginal('quantity');
                if($stockQuantity < $quantity){
                    $productName = $stock->product->name;
                    throw new Exception('Stock product '.$productName.' di lokasi '.$stock->storageLocation->name.' ('.$stockQuantity.') lebih kecil dari '.$quantity);
                }                
            }else{
                $product = Product::find($productId);
                $productName = $product->name;
                throw new Exception('Stock product '.$productName.' di lokasi '.$stock->storageLocation->name.' (0) lebih kecil dari '.$quantity);
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
        $model->stockMoveLines()->delete();
        return $model->delete();
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
