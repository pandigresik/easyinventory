<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StockMove;
use App\Repositories\BaseRepository;

/**
 * Class StockMoveRepository
 * @package App\Repositories\Inventory
 * @version November 28, 2022, 10:56 am WIB
*/

class StockMoveRepository extends BaseRepository
{    
    protected $moveType = 'IN';
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
            $model = $this->model->newInstance($input);
            $model->stock_move_type = $this->moveType;            
            $model->save();
            $this->setDetails($detail, $model);
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
            $this->setDetails($detail, $model);
            $this->model->getConnection()->commit();

            return $model;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $this->model->getConnection()->rollBack();

            return $e;
        }
    }

    private function setDetails($detail, $model)
    {
        $model->stockMoveLines()->forceDelete();
        if (!empty($detail)) {
            foreach ($detail['product_id'] as $key => $item) {
                $model->stockMoveLines()->create([
                    'product_id' => $detail['product_id'][$key] ?? null,
                    'storage_location_id' => $detail['storage_location_id'][$key] ?? null,
                    'description' => $detail['description'][$key] ?? null,
                    'quantity' => $detail['quantity'][$key] ?? null,
                    'lot_number' => $detail['lot_number'][$key] ?? null,
                ]);
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
