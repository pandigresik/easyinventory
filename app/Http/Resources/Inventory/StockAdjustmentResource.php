<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Resources\Json\JsonResource;

class StockAdjustmentResource extends JsonResource
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
            'number' => $this->number,
            'transaction_date' => $this->transaction_date,
            'description' => $this->description
        ];
    }
}
