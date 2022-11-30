<?php

namespace Modules\PIM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dpt_dom_id' => 'required',
            'dpt_en_id' => 'required',
            'dpt_code' => 'required',
            'dpt_desc' => 'required',
            'dpt_dir_id' => 'nullable',
            'dpt_div_id' => 'nullable'
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
