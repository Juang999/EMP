<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanRequest extends FormRequest
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
            'dpt_id' => 'required',
            'nomor_telepon' => 'nullable',
            'alasan' => 'required',
            'tipe_alasan' => 'required',
            'en_id' => 'required',
            'status' => 'required',
            'tipe_rekrutmen' => 'required',
            'level' => 'required',
            'jabatan' => 'required',
            'posisi' => 'required',
            'jumlah_pria' => 'nullable',
            'jumlah_wanita' => 'nullable',
            'lokasi' => 'required',
            'atasan_id' => 'required',
            'tingkat_pendidikan' => 'required',
            'jurusan' => 'required',
            'pengalaman' => 'required',
            'pengetahuan_dan_keahlian' => 'required',
            'deskripsi_pekerjaan' => 'required',
            'ekspetasi_join' => 'required',
            // 'pgj_en_id' => 'required',
            // 'pgj_alasan' => 'required',
            // 'pgj_jumlah' => 'required',
            // 'pgj_jenis_kelamin' => 'required',
            // 'pgj_status_karyawan' => 'nullable',
            // 'pgj_lama_kontrak' =>  'nullable',
            // 'pgj_level' => 'nullable',
            // 'pgj_pangkat' => 'nullable',
            // 'pgj_rentang_gaji_min' => 'nullable',
            // 'pgj_rentang_gaji_max' => 'nullable',
            // 'pgj_tgl_terpenuhi' => 'nullable',
            // 'pgj_usia_min' => 'nullable',
            // 'pgj_usia_max' => 'nullable',
            // 'pgj_status_marital' => 'nullable',
            // 'pgj_pendidikan' => 'nullable',
            // 'pgj_jurusan' => 'nullable',
            // 'pgj_bahasa' => 'nullable',
            // 'pgj_kemampuan_bahasa' => 'nullable',
            // 'pgj_keahlian_komputer' => 'nullable',
            // 'pgj_pengalaman' => 'nullable',
            // 'pgj_syarat_lain' => 'nullable',
            // 'pgj_job1' => 'nullable',
            // 'pgj_job2' => 'nullable',
            // 'pgj_job3' => 'nullable',
            // 'pgj_job4' => 'nullable',
            // 'pgj_job5' => 'nullable',
            // 'pgj_job6' => 'nullable',
            // 'pgj_job7' => 'nullable',
            // 'pgj_job8' => 'nullable',
            // 'pgj_stts_kry_id' => 'nullable',
            // 'pgj_pangkat_id' => 'nullable',
            // 'pgj_level_id' => 'nullable',
            // 'pgj_marital_id' => 'nullable',
            // 'pgj_stts_iklan' => 'nullable',
            // 'pgj_jabatan' => 'nullable'
        ];
    }
}
