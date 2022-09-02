<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalInformationManagementRequest extends FormRequest
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
            // emp_mstr
            "fname" => "required",
            "mname" => "required",
            "lname" => "required",
            "gender" => "required",
            // 'PosId' => 'required',
            "birthDate" => "required",
            "birthPlace" => "required",
            "relation" => "required",
            // 'areaId' => 'required',
            "noKtp" => "required",
            "pin" => "required",
            "tinggiBadan" => "required",
            "beratBadan" => "required",
            "penyakit" => "required",
            "cacat" => "required",
            "tlpRumah" => "required",
            "tlpAlt" => "required",
            "hp" => "required",
            "email" => "required",
            "web" => "required",
            "inisial" => "required",
            "tglMasuk" => "required",
            "hrGolId" => 'required',
            // "hrStatusId" => 'required',
            // "hrPosId" => 'required',
            'hrPangkatId' => 'required',
            "statKoperasi" => "required",
            "active" => "required",
            // "finger" => 'required',
            "nikNew" => "required",
            "tglKeluar" => "required",
            "alasanKeluar" => "required",
            "nikOld" => "required",
            "address" => "required",
            "photo" => "required",
            "type" => "required",
            "kota" => "required",
            "propinsi" => "required",
            "kodePos" => "required",
            'enId' => 'required',
            "statMarital" => "required",
            "noRek" => "required",
            "idFinger" => "required",
            "workGroup" => "required",
            "gajiPokok" => "required",
            "tTransport" => "required",
            "tPerumahan" => "required",
            "tBbm" => "required",
            "tTelpon" => "required",
            "tMakan" => "required",
            "tFungsional" => "required",
            "upahKerjaBorongan" => "required",
            // "privilegeFinger" => "required",
            // "passwordFinger" => "required",
            "noUrut" => "required",
            "hirarki" => "required",
            "npwp" => "required",
            "namaKlrgDekat" => "required",
            "klrgDekatHub" => 'required',
            "emailAlt" => "required",
            "jabatan" => "required",
            "foto" => "required",
            "potMakan" => "required",
            "bank" => "required",
            "tJabatan" => "required",
            "kotaUmk" => "required",
            "potBpjs" => "required",
            "tKepangkatan" => "required",
            "potZakat" => "required",
            "zis" => "required",
            // hr_keluarga
            "hub_id" => "required",
            "nama" => "required",
            "remarks" => "required",
            "tglLahir" => "required",
            "tmptLahir" => "required",
            // hr_organisasi
            'organisasi' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'jnsOrganisasi' => 'required',
            'masaJabatan' => 'required',
            'orgStart' => 'required',
            'orgEnd' => 'required',

        ];
    }
}
