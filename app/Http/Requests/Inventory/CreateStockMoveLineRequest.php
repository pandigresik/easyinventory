<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Inventory\StockMoveLine;

class CreateStockMoveLineRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $permissionName = 'stock_move_lines-create';
        return Auth::user()->can($permissionName);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return StockMoveLine::$rules;
    }

    /**
     * Get all of the input based value from property fillable  in model and files for the request.
     *
     * @param null|array|mixed $keys
     *
     * @return array
    */
    public function all($keys = null){
        $keys = (new StockMoveLine)->fillable;
        return parent::all($keys);
    }
}
