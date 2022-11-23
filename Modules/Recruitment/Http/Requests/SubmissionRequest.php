<?php

namespace Modules\Recruitment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'recruitmentDivisi' => 'required|integer',
            'recruitmentNoWhatsapp' => 'required',
            'recruitmentAlasan' => 'required',
            'recruitmentTypeAlasan' => 'required',
            'recruitmentEntitas' => 'required',
            'recruitmentStatus' => 'required',
            'recruitmentType' => 'required',
            'recruitmentLevel' => 'required',
            'recruitmentJabatan' => 'required',
            'recruitmentPosisi' => 'required',
            'recruitmentJmlPria' => 'nullable',
            'recruitmentJmlWanita' => 'nullable',
            'recruitmentLokasi' => 'required',
            'recruitmentAtasan' => 'required',
            'recruitmentTingkatPendidikan' => 'required',
            'recruitmentJurusan' => 'required',
            'recruitmentPengalaman' => 'required',
            'recruitmentPengetahuanDanKeahlian' => 'required',
            'recruitmentDeskripsi' => 'required',
            'recruitmentEkspektasiJoin' => 'required',
            'recruitmentNamaPengaju' => 'required'
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
