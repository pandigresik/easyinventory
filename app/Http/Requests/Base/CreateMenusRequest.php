<?php

namespace App\Http\Requests\Base;

use App\Models\Base\Menus;
use Illuminate\Foundation\Http\FormRequest;

class CreateMenusRequest extends FormRequest
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
        return Menus::$rules;
    }
}
