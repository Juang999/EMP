<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CodeMaster;
use App\Models\EmpMaster;
use App\Models\EnMaster;
use App\Models\HRHobbies;
use App\Models\HrJabatanMaster;
use App\Models\HRKeahlian;
use App\Models\HRKeluarga;
use App\Models\HRMasaSP;
use App\Models\HROrganisasi;
use App\Models\HRPersonality;
use App\Models\HRPosisi;
use App\Models\HRPosMaster;
use App\Models\HRPrestasi;
use App\Models\HRSakit;
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
        try {
            // $theData = EmpMaster::where('emp_id', 1)->get(['emp_fname', 'emp_mname', 'emp_lname', 'emp_id', 'emp_hrstatus_id', 'emp_gender', 'emp_jabatan', 'emp_en_id', 'emp_hp']);

            // foreach ($theData as $data) {
            //     $data['status'] = CodeMaster::where('code_id', $data->emp_hrstatus_id)->get();
            //     $data['jabatan'] = HrJabatanMaster::where('hrjbt_id', $data->emp_jabatan)->get();
            //     $data['entity'] = EnMaster::where('en_id', $data->emp_en_id)->get();
            //     $data['total_keluarga'] = HRKeluarga::where('hrkel_emp_id', $data->emp_id)->count();
            //     $data['total_organisasi'] = HROrganisasi::where('hrorg_emp_id', $data->emp_id)->count();
            //     $data['total_prestasi'] = HRPrestasi::where('hrpres_emp_id', $data->emp_id)->count();
            //     $data['total_keahlian'] = HRKeahlian::where('hrahli_emp_id', $data->emp_id)->count();
            //     $data['total_SP'] = HRMasaSP::where('hrsp_emp_id', $data->emp_id)->count();
            //     $data['total_sakit'] = HRSakit::where('hrsakit_emp_id', $data->emp_id)->count();
            // }
            $theData = DB::table('public.emp_mstr')->select(DB::raw('public.emp_mstr.emp_fname, public.emp_mstr.emp_mname, public.emp_mstr.emp_lname, public.emp_mstr.emp_id, public.emp_mstr.emp_hrstatus_id, public.emp_mstr.emp_gender, public.emp_mstr.emp_jabatan, public.emp_mstr.emp_en_id, public.emp_mstr.emp_hp, public.code_mstr.code_id, public.code_mstr.code_name, hris.hrjabatan_mstr.hrjbt_id, hris.hrjabatan_mstr.hrjbt_name, public.en_mstr.en_id, public.en_mstr.en_desc, COUNT(hris.hr_keluarga.hrkel_emp_id) AS total_keluarga, COUNT(hris.hr_organisasi.hrorg_emp_id) AS total_organisasi, COUNT(hris.hr_prestasi.hrpres_emp_id) AS total_prestasi, COUNT(hris.hr_keahlian.hrahli_emp_id) AS total_keahlian, COUNT(hris.hr_masa_sp.hrsp_emp_id) AS total_SP, COUNT(hris.hr_sakit.hrsakit_emp_id) AS total_sakit'))
            ->leftJoin('public.code_mstr', 'public.emp_mstr.emp_hrstatus_id', '=', 'public.code_mstr.code_id')
            ->leftJoin('hris.hrjabatan_mstr', 'public.emp_mstr.emp_jabatan', '=', 'hris.hrjabatan_mstr.hrjbt_id')
            ->leftJoin('public.en_mstr', 'public.emp_mstr.emp_en_id', '=', 'public.en_mstr.en_id')
            ->leftJoin('hris.hr_keluarga', 'hris.hr_keluarga.hrkel_emp_id', '=', 'public.emp_mstr.emp_id')
            ->leftJoin('hris.hr_organisasi', 'hris.hr_organisasi.hrorg_emp_id', '=', 'public.emp_mstr.emp_id')
            ->leftJoin('hris.hr_prestasi', 'hris.hr_prestasi.hrpres_emp_id', '=', 'public.emp_mstr.emp_id')
            ->leftJoin('hris.hr_keahlian', 'hris.hr_keahlian.hrahli_emp_id', '=', 'public.emp_mstr.emp_id')
            ->leftJoin('hris.hr_masa_sp', 'hris.hr_masa_sp.hrsp_emp_id', '=', 'public.emp_mstr.emp_id')
            ->leftJoin('hris.hr_sakit', 'hris.hr_sakit.hrsakit_emp_id', '=', 'public.emp_mstr.emp_id')
            ->groupBy('public.emp_mstr.emp_fname', 'public.emp_mstr.emp_mname', 'public.emp_mstr.emp_lname', 'public.emp_mstr.emp_id', 'public.emp_mstr.emp_hrstatus_id', 'public.emp_mstr.emp_gender', 'public.emp_mstr.emp_jabatan', 'public.emp_mstr.emp_en_id', 'public.emp_mstr.emp_hp', 'public.code_mstr.code_id', 'public.code_mstr.code_name', 'hris.hrjabatan_mstr.hrjbt_id', 'hris.hrjabatan_mstr.hrjbt_name', 'public.en_mstr.en_id', 'public.en_mstr.en_desc')
            ->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'data' => $theData,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambii data',
                'galat' => $th->getMessage(),
                'line' => $th->getLine(),
                'code' => 400
            ], 400);
        }
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

            $rawNIK = EmpMaster::count();
            if (!$rawNIK) {
                $rawNIK = 1;
            } else {
                $rawNIK++;
            }

            $base = "0000";

            $func = array_slice(str_split($base), 0, -strlen($rawNIK));
            $NIK = implode($func).$rawNIK;

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
                'emp_hrpos_id' => $request->hrPosId,
                'emp_pangkat_id' => $request->PangkatId,
                'emp_status_koperasi' => $request->statKoperasi,
                'emp_active' => $request->active,
                'emp_finger' => $request->finger,
                'emp_nik_old' => $request->nikOld,
                'emp_nik_new' => $NIK.'.'.Carbon::now()->format('m.y'),
                'emp_hrstatus_id' => $request->hrStatusId,
                'emp_tgl_keluar' => $request->tglKeluar,
                'emp_alasan_keluar' => $request->alasanKeluar,
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
                'emp_jabatan' => $request->jabatanId,
                'emp_bpjs' => $request->bpjs
            ]);

            UseAset::create([
                'use_aset_oid' => Str::uuid(),
                'use_aset_emp_id' => $employee->emp_id,
                'use_aset_add_by' => Auth::user()->usernama,
                'use_aset_add_date' => Carbon::translateTimeString(now())
            ]);

            $sequence = HRPosisi::where('hrpos_emp_id', $employee->emp_id)->count();

            if (!$sequence) {
                $sequence = 1;
            } elseif ($sequence == 5) {
                return response()->json([
                    'status' => 'redirected',
                    'pesan' => 'kamu telah mencapai limit',
                    'limit' => 5,
                    'code' => 300
                ], 300);
            } else {
                $sequence++;
            }

            $posisi = HRPosMaster::where('hrpos_id', $request->hrPosId)->first();

            HRPosisi::create([
                'hrpos_oid' => Str::uuid(),
                'hrpos_emp_id' => $employee->emp_id,
                'hrpos_seq' => $sequence,
                'hrpos_posisi' => $posisi->hrpos_name,
                'hrpos_start' => Carbon::now()->format('Y-m-d'),
                'hrpos_remarks' => $request->keteranganPosisi
            ]);

            $count = HRHobbies::where('hr_hobbies_emp_id', $request->emp_id)->count();

            if ($count == 5) {
                return response()->json([
                    'status' => 'gagal',
                    'pesan' => 'input telah mencapai limit',
                    'limit' => 5,
                    'code' => 300
                ], 300);
            }

            foreach ($request->codeIdHobbies as $hobby) {
                HRHobbies::create([
                    'hr_hobbies_oid' => Str::uuid(),
                    'hr_hobbies_emp_id' => $employee->emp_id,
                    'hr_hobbies_code_id' => $hobby['value'],
                    'hr_hobbies_datecreate' => Carbon::now()->format('Y-m-d')
                ]);
            }

            $data = HRPersonality::create([
                'hr_persnlt_oid' => Str::uuid(),
                'hr_persnlt_emp_id' => $employee->emp_id,
                'hr_persnlt_code_id' => $request->codeIdPersonality,
                'hr_persnlt_date' => $request->datePersonality,
                'hr_persnlt_exm' => $request->exmPersonality
            ]);

            EmpMaster::where('emp_id', $employee->emp_id)->update([
                'emp_persnlt_code_id' => $data->hr_persnlt_code_id
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
        try {
            $data = DB::table('public.emp_mstr')->select(DB::raw('public.emp_mstr.*, public.en_mstr.en_desc, public.hrjabatan_mstr.hrjbt_name, hris.hrgol_mstr.*, public.pangkat_mstr.*, public'))
            ->leftJoin('public.code_mstr', 'public.emp_mstr.emp_hrstatus_id', '=', 'public.code_mstr.code_id')
            ->leftJoin('hris.hrjabatan_mstr', 'public.emp_mstr.emp_jabatan', '=', 'hris.hrjabatan_mstr.hrjbt_id')
            ->leftJoin('public.en_mstr', 'public.emp_mstr.emp_en_id', '=', 'public.en_mstr.en_id')
            ->where('emp_id', $emp_id)->first();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data',
                'galat' => $th->getMessage(),
                'line' => $th->getLine(),
                'code' => 400
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $emp_id)
    {
        try {
            EmpMaster::where('emp_id', $emp_id)->update([
                ''
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
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
