<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
        return [
            'organisasi' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'jnsOrganisasi' => 'required',
            'masaJabatan' => 'required',
            'orgStart' => 'required',
            'orgEnd' => 'required'
        ];
    }
}
