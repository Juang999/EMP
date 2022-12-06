<?php

namespace Modules\PIM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitSubSectionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'usect_dom_id' => 'required',
            'usect_en_id' => 'required',
            'usect_code' => 'required',
            'usect_desc' => 'required',
            'usect_ssect_id' => 'nullable',
            'usect_sect_id' => 'nullable',
            'usect_dpt_id' => 'nullable',
            'usect_div_id' => 'nullable',
            'usect_dir_id' => 'nullable',
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
