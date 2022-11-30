<?php

namespace Modules\PIM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DivisionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'div_dom_id' => 'required',
            'div_en_id' => 'required',
            'div_code' => 'required',
            'div_desc' => 'required',
            'div_dir_id' => 'nullable'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
