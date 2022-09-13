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
use Illuminate\Support\Str;

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
        // dd($request->all());

        try {
            DB::beginTransaction();

            $name = explode(' ', $request->namaLengkap);

            $emp_id = EmpMaster::orderBy('emp_add_date', 'DESC')->first('emp_id');

            if (!$emp_id) {
                $emp_id = 1;
            } else {
                $emp_id++;
            }

            // dd($request->all());

            $photo = base64_encode(file_get_contents($request->file('photo')));

            $employee = EmpMaster::create([
                'emp_oid' => Str::uuid(),
                'emp_add_by' => Auth::user()->usernama, //done
                'emp_add_date' => Carbon::now(), //done
                'emp_id' => $emp_id, //done
                'emp_fname' => $name[0], //done
                'emp_mname' => $request->namaPanggilan, //done
                'emp_lname' => ($name[1]) ? $name[1].$name[2] : '-', //done
                'emp_gender' => $request->gender, //done
                // 'emp_pos_id' => $request->PosId,
                'emp_dt' => Carbon::now(), //done
                'emp_birth_date' => $request->tglLahir, //done
                'emp_birth_place' => $request->tmptLahir, //done
                'emp_relation' => $request->relation, //relasi keluarga
                'emp_area_id' => $request->areaId, //done
                'emp_no_ktp' => $request->noKtp, //done
                'emp_pin' => $request->pin, //done
                'emp_tinggi_badan' => $request->tinggiBadan, //done
                'emp_berat_badan' => $request->beratBadan, //done
                'emp_penyakit' => $request->penyakit, //done
                'emp_cacat' => $request->cacat, //done
                'emp_telp_rumah' => $request->tlpRumah, //done
                'emp_telp_alt' => $request->telpAlt, //done
                'emp_hp' => $request->hp, //done
                'emp_email' => $request->email, //done
                'emp_website' => $request->web, //done
                'emp_inisial' => $request->inisial, //done
                'emp_tgl_masuk' => $request->tglMasuk,
                'emp_hrgol_id' => $request->hrGolId,
                'emp_hrstatus_id' => $request->hrStatusId,
                'emp_pangkat_id' => $request->PangkatId,
                // 'emp_status_koperasi' => $request->statKoperasi,
                'emp_active' => $request->active,
                'emp_finger' => $request->finger,
                'emp_nik_new' => $request->nikNew,
                'emp_tgl_keluar' => $request->tglKeluar,
                'emp_alasan_keluar' => $request->alasanKeluar,
                'emp_nik_old' => $request->nikOld,
                'emp_address' => $request->address,
                'emp_photo' => $photo,
                // 'emp_type' => $request->type,
                'emp_kota' => $request->kota,
                'emp_propinsi' => $request->propinsi,
                'emp_kd_pos' => $request->kodePos,
                'emp_en_id' => $request->enId,
                'emp_status_marital' => $request->statMarital,
                'emp_no_rek' => $request->noRek,
                // 'emp_id_finger' => $request->idFinger,
                'emp_work_group' => $request->workGroup,
                'emp_privilege_finger' => $request->privilegeFInger,
                'emp_password_finger' => $request->passwordFinger,
                // 'emp_no_urut' => $request->noUrut,
                'emp_hirarki' => $request->hirarki,
                'emp_npwp' => $request->npwp,
                'emp_nama_klrg_dekat' => $request->namaKlrgDekat,
                'emp_klrg_dekat_hub' => $request->klrgDekatHub,
                'emp_email_alt' => $request->emailAlt,
                'emp_jabatan' => $request->jabatan
            ]);

        DB::commit();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat data baru karyawan',
                'data' => $employee
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menginputkan data karyawan',
                'galat' => $th->getMessage()
            ], 400);
        }
    }
}
