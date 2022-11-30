<?php

namespace Modules\PIM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DirectorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dir_dom_id' => 'required',
            'dir_en_id' => 'required',
            'dir_code' => 'required',
            'dir_desc' => 'required'
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
