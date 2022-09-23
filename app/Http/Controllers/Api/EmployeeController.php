<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmpMaster;
use App\Models\UseAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $name = explode(' ', $request->namaLengkap);

            $count = count($name) - 1;

            $emp_id_and_finger = EmpMaster::orderBy('emp_add_date', 'DESC')->first('emp_id');

            if (!$emp_id_and_finger) {
                $emp_id_and_finger = 1;
            } else {
                $emp_id_and_finger->emp_id++;
            }

            // $photo = base64_encode(file_get_contents($request->file('photo')));

            $employee = EmpMaster::create([
                'emp_oid' => Str::uuid(),
                'emp_add_by' => Auth::user()->usernama, //done
                'emp_add_date' => Carbon::now(), //done
                'emp_id' => $emp_id_and_finger->emp_id, //done
                'emp_fname' => $name[0], //done
                'emp_mname' => $request->namaPanggilan, //done
                'emp_lname' => ($count > 0) ? $name[$count] : NULL, //done
                'emp_gender' => $request->gender, //done
                'emp_dt' => Carbon::now(), //done
                'emp_birth_date' => $request->tglLahir, //done
                'emp_birth_place' => $request->tmptLahir, //done
                'emp_area_id' => $request->areaId, //done
                'emp_no_ktp' => $request->noKtp, //done
                'emp_pin' => $request->pin, //done
                // 'emp_tinggi_badan' => $request->tinggiBadan, //done
                // 'emp_berat_badan' => $request->beratBadan, //done
                // 'emp_penyakit' => $request->penyakit,
                // 'emp_cacat' => $request->cacat,
                'emp_telp_rumah' => $request->tlpRumah, //done
                'emp_telp_alt' => $request->telp2, //done
                'emp_hp' => $request->hp, //done
                'emp_email' => $request->email, //done
                // 'emp_website' => $request->web, //done
                'emp_inisial' => $request->inisial, //done
                'emp_tgl_masuk' => $request->tglMasuk,
                'emp_hrgol_id' => $request->hrGolId,
                'emp_hrstatus_id' => $request->hrStatusId,
                'emp_pangkat_id' => $request->PangkatId,
                'emp_status_koperasi' => $request->statKoperasi,
                'emp_active' => $request->active,
                'emp_finger' => $request->finger,
                'emp_nik_new' => $request->nikNew,
                'emp_tgl_keluar' => $request->tglKeluar,
                'emp_alasan_keluar' => $request->alasanKeluar,
                'emp_nik_old' => $request->nikOld,
                'emp_address' => $request->address,
                'emp_photo' => $request->photo,
                // 'emp_type' => $request->type,
                'emp_kota' => $request->kota,
                'emp_propinsi' => $request->propinsi,
                'emp_kd_pos' => $request->kodePos,
                'emp_en_id' => $request->enId,
                'emp_status_marital' => $request->statMarital,
                'emp_no_rek' => $request->noRek,
                'emp_id_finger' => $request->idFinger,
                // 'emp_gaji_pokok' => $request->gajiPokok,
                // 'emp_t_transport' => $request->tTransport,
                'emp_work_group' => $request->workGroup,
                'emp_privilege_finger' => $request->privilegeFInger,
                'emp_password_finger' => $request->passwordFinger,
                'emp_no_urut' => $request->noUrut,
                'emp_hirarki' => $request->hirarki,
                'emp_npwp' => $request->npwp,
                'emp_email_alt' => $request->emailAlt,
                'emp_jabatan' => $request->jabatanId
            ]);

            UseAset::create([
                'use_aset_oid' => Str::uuid(),
                'use_aset_emp_id' => $employee->emp_id,
                'use_aset_add_by' => Auth::user()->usernama,
                'use_aset_add_date' => Carbon::translateTimeString(now())
            ]);

        DB::commit();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat data baru karyawan',
                'data' => $employee,
                'code' => 200
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menginputkan data karyawan',
                'galat' => $th->getMessage(),
                'baris' => $th->getLine(),
                'code' => 400
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($emp_id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
