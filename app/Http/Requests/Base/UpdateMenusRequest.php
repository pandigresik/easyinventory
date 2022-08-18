<?php

namespace App\Http\Requests\Base;

use App\Models\Base\Menus;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenusRequest extends FormRequest
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
        $rules = Menus::$rules;
        $id = $this->route('menu');
        $rules['name'] = $rules['name'].','.$id;

        return $rules;
    }
}
