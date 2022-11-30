<?php

namespace Modules\PIM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sect_dom_id' => 'required',
            'sect_en_id' => 'required',
            'sect_code' => 'required',
            'sect_desc' => 'required',
            'sect_div_id' => 'nullable',
            'sect_dir_id' => 'nullable',
            'sect_dpt_id' => 'nullable'
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
