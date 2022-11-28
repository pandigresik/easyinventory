<?php

namespace App\Http\Resources\Inventory;

use Illuminate\Http\Resources\Json\JsonResource;

class UomResource extends JsonResource
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
            'name' => $this->name,
            'category_id' => $this->category_id,
            'factor' => $this->factor,
            'rounding' => $this->rounding,
            'uom_type_id' => $this->uom_type_id,
            'uom_category_id' => $this->uom_category_id
        ];
    }
}
