<?php

namespace App\Http\Requests\API\Inventory;

use App\Models\Inventory\StockMoveType;
use InfyOm\Generator\Request\APIRequest;

class UpdateStockMoveTypeAPIRequest extends APIRequest
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
        $rules = StockMoveType::$rules;
        
        return $rules;
    }
}
