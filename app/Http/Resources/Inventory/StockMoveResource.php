<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Resources\Json\JsonResource;

class StockMoveResource extends JsonResource
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
            'transaction_date' => $this->transaction_date,
            'number' => $this->number,
            'references' => $this->references,
            'responsbility' => $this->responsbility,
            'warehouse_id' => $this->warehouse_id,
            'stock_move_type_id' => $this->stock_move_type_id
        ];
    }
}
