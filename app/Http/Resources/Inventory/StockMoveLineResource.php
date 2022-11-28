<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Resources\Json\JsonResource;

class StockMoveLineResource extends JsonResource
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
            'stock_move_id' => $this->stock_move_id,
            'product_id' => $this->product_id,
            'storage_location_id' => $this->storage_location_id,
            'quantity' => $this->quantity,
            'description' => $this->description
        ];
    }
}
