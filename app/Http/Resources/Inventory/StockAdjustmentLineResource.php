<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Resources\Json\JsonResource;

class StockAdjustmentLineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'storage_location_id' => $this->storage_location_id,
            'count_quantity' => $this->count_quantity,
            'onhand_quantity' => $this->onhand_quantity,
            'transaction_date' => $this->transaction_date,
            'description' => $this->description,
            'state' => $this->state
        ];
    }
}
