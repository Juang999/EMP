<?php

namespace Modules\PIM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubSectionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ssect_dom_id' => 'required',
            'ssect_en_id' => 'required',
            'ssect_code' => 'required',
            'ssect_desc' => 'required',
            'ssect_sec_id' => 'nullable',
            'ssect_dept_id' => 'nullable',
            'ssect_div_id' => 'nullable',
            'ssect_dir_id' => 'nullable'
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
