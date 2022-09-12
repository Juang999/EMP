<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalInformationManagementRequest;
use App\Models\EmpMaster;
use App\Models\HRKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PersonalInformationManagement extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        dd($request->all());

        try {
            DB::beginTransaction();

            $name = explode(' ', $request->namaLengkap);

            $emp_id = EmpMaster::orderBy('emp_add_date', 'DESC')->first('emp_id');

            if (!$emp_id) {
                $emp_id = 1;
            } else {
                $emp_id++;
            }

            $photo = base64_encode(file_get_contents($request->file('photo')));

            $employee = EmpMaster::create([
                'emp_add_by' => Auth::user()->usernama,
                'emp_add_date' => Carbon::now(),
                'emp_id' => $emp_id,
                'emp_fname' => $name[0],
                'emp_mname' => ($name[1]) ? $name[1] : '-',
                'emp_lname' => ($name[2]) ? $name[2] : '-',
                'emp_gender' => $request->gender,
                // 'emp_pos_id' => $request->PosId,
                'emp_dt' => Carbon::now(),
                'emp_birth_date' => $request->tglLahir,
                'emp_birth_place' => $request->tmptLahir,
                'emp_relation' => $request->relation, //relasi keluarga
                'emp_area_id' => $request->areaId,
                'emp_no_ktp' => $request->noKtp,
                'emp_pin' => $request->pin,
                'emp_tinggi_badan' => $request->tinggiBadan,
                'emp_berat_badan' => $request->beratBadan,
                'emp_penyakit' => $request->penyakit,
                'emp_cacat' => $request->cacat,
                'emp_telp_rumah' => $request->tlpRumah,
                'emp_telp_alt' => $request->telpAlt,
                'emp_hp' => $request->hp,
                'emp_email' => $request->email,
                'emp_website' => $request->web,
                'emp_inisial' => $request->inisial,
                'emp_tgl_masuk' => $request->tglMasuk,
                'emp_hrgol_id' => $request->hrGolId,
                'emp_hrstatus_id' => $request->hrStatusId,
                // 'emp_hrpos_id' => $request->hrPosId,
                'emp_pangkat_id' => $request->PangkatId,
                'emp_status_koperasi' => $request->statKoperasi,
                'emp_active' => $request->active,
                // 'emp_finger' => $request->finger,
                'emp_nik_new' => $request->nikNew,
                'emp_tgl_keluar' => $request->tglKeluar,
                'emp_alasan_keluar' => $request->alasanKeluar,
                'emp_nik_old' => $request->nikOld,
                'emp_address' => $request->address,
                'emp_photo' => $photo,
                'emp_type' => $request->type,
                'emp_kota' => $request->kota,
                'emp_propinsi' => $request->propinsi,
                'emp_kd_pos' => $request->kodePos,
                'emp_en_id' => $request->enId,
                'emp_status_marital' => $request->statMarital,
                'emp_no_rek' => $request->noRek,
                'emp_id_finger' => $request->idFinger,
                'emp_work_group' => $request->workGroup,
                'emp_privilege_finger' => $request->privilegeFInger,
                'emp_password_finger' => $request->passwordFinger,
                // 'emp_no_urut' => $request->noUrut,
                'emp_hirarki' => $request->hirarki,
                'emp_npwp' => $request->npwp,
                'emp_nama_klrg_dekat' => $request->namaKlrgDekat,
                'emp_klrg_dekat_hub' => $request->klrgDekatHub,
                'emp_email_alt' => $request->emailAlt,
                // 'emp_jabatan' => $request->jabatan,
                'emp_t_jabatan' => $request->tJabatan,
                'emp_kota_umk' => $request->kotaUmk,
                'emp_t_kepangkatan' => $request->tKepangkatan,
            ]);

        DB::commit();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat data baru karyawan',
                'data' => $employee
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
