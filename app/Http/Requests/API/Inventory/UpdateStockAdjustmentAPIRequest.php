<?php

namespace App\Http\Requests\API\Inventory;

use App\Models\Inventory\StockAdjustment;
use InfyOm\Generator\Request\APIRequest;

class UpdateStockAdjustmentAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = StockAdjustment::$rules;
        
        return $rules;
    }
}
