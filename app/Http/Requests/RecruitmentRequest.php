<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruitmentRequest extends FormRequest
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
            'plm_nama' => 'required',
            'plm_posisi' => 'requ,ired',
            'plm_tempat_lahir' => 'required',
            'plm_tgl_lahir' => 'required',
            'plm_suku' => 'required',
            'plm_gol_darah' => 'required',
            'plm_tinggi' => 'required',
            'plm_berat' => 'required',
            'plm_jns_kelamin' => 'required',
            'plm_telepon' => 'required',
            'plm_hobi' => 'required',
            'plm_alamat' => 'required',
            'plm_kota' => 'required',
            'plm_propinsi' => 'required',
            'plm_anak_ke' => 'required',
            'plm_anak_dari' => 'required',
            'plm_cita_cita' => 'required',
            'plm_status_marital' => 'required',
            'plm_jml_anak' => 'nullable',
            'plm_status_rumah' => 'required',
            'plm_kendaraan' => 'required',
            'plm_sim' => 'required',
            'plm_ayah' => 'required',
            'plm_ibu' => 'required',
            'bahasa' => 'nullable',
            'keterampilan' => 'nullable',
            'organisasi' => 'nullable',
            'pendidikan' => 'nullable',
            'pengalaman' => 'nulllable',
            'saudara' => 'nullable'
        ];
    }
}
