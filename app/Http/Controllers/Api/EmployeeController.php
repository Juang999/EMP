<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CodeMaster;
use App\Models\EmpMaster;
use App\Models\EnMaster;
use App\Models\HRGolMaster;
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
use App\Models\PangkatMaster;
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
            $theData = DB::table('public.emp_mstr')->select(DB::raw('public.emp_mstr.emp_oid, public.emp_mstr.emp_fname, public.emp_mstr.emp_mname, public.emp_mstr.emp_lname, public.emp_mstr.emp_id, public.emp_mstr.emp_en_id, public.emp_mstr.emp_jabatan, public.en_mstr.en_id, public.en_mstr.en_desc, hris.hrjabatan_mstr.hrjbt_id, hris.hrjabatan_mstr.hrjbt_name'))
            ->leftJoin('public.en_mstr', 'public.en_mstr.en_id', '=', 'public.emp_mstr.emp_en_id')
            ->leftJoin('hris.hrjabatan_mstr', 'hris.hrjabatan_mstr.hrjbt_id', '=', 'public.emp_mstr.emp_jabatan')
            ->orderBy('public.emp_mstr.emp_fname')
            ->get();

            foreach ($theData as $data) {
                $data->total_keluarga = DB::table('hris.hr_keluarga')->where('hrkel_emp_id', $data->emp_id)->count();
                $data->total_organisasi = DB::table('hris.hr_organisasi')->where('hrorg_emp_id', $data->emp_id)->count();
                $data->total_prestasi = DB::table('hris.hr_prestasi')->where('hrpres_emp_id', $data->emp_id)->count();
                $data->total_keahlian = DB::table('hris.hr_keahlian')->where('hrahli_emp_id', $data->emp_id)->count();
                $data->total_SP = DB::table('hris.hr_masa_sp')->where('hrsp_emp_id', $data->emp_id)->count();
                $data->total_riwayat_penyakit = DB::table('hris.hr_sakit')->where('hrsakit_emp_id', $data->emp_id)->count();
            }

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
                'file' => $th->getFile(),
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

            // $hobbies = json_decode($request->codeIdHobbies, true);

            foreach ($request->codeIdHobbies as $hobby) {
                HRHobbies::create([
                    'hr_hobbies_oid' => Str::uuid(),
                    'hr_hobbies_emp_id' => $employee->emp_id,
                    'hr_hobbies_code_id' => $hobby['value'],
                    'hr_hobbies_datecreate' => Carbon::translateTimeString(now())
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
            $data = DB::table('public.emp_mstr')->select(DB::raw("
            public.emp_mstr.emp_fname,
            public.emp_mstr.emp_mname,
            public.emp_mstr.emp_lname,
            public.emp_mstr.emp_orgs_id,
            public.emp_mstr.emp_orgs_aprv,
            public.emp_mstr.emp_gender,
            public.emp_mstr.emp_pos_id,
            public.emp_mstr.emp_dt,
            public.emp_mstr.emp_birth_date,
            public.emp_mstr.emp_birth_place,
            public.emp_mstr.emp_relation,
            public.emp_mstr.emp_area_id,
            public.emp_mstr.emp_no_ktp,
            public.emp_mstr.emp_tinggi_badan,
            public.emp_mstr.emp_berat_badan,
            public.emp_mstr.emp_penyakit,
            public.emp_mstr.emp_cacat,
            public.emp_mstr.emp_telp_rumah,
            public.emp_mstr.emp_telp_alt,
            public.emp_mstr.emp_hp,
            public.emp_mstr.emp_email,
            public.emp_mstr.emp_website,
            public.emp_mstr.emp_inisial,
            public.emp_mstr.emp_tgl_masuk,
            public.emp_mstr.emp_hrgol_id,
            public.emp_mstr.emp_hrstatus_id,
            public.emp_mstr.emp_hrpos_id,
            public.emp_mstr.emp_pangkat_id,
            public.emp_mstr.emp_status_koperasi,
            public.emp_mstr.emp_active,
            public.emp_mstr.emp_nik_new,
            public.emp_mstr.emp_tgl_keluar,
            public.emp_mstr.emp_alasan_keluar,
            public.emp_mstr.emp_nik_old,
            public.emp_mstr.emp_address,
            public.emp_mstr.emp_type,
            public.emp_mstr.emp_kota,
            public.emp_mstr.emp_propinsi,
            public.emp_mstr.emp_kd_pos,
            public.emp_mstr.emp_en_id,
            public.emp_mstr.emp_status_marital,
            public.emp_mstr.emp_no_rek,
            public.emp_mstr.emp_id_finger,
            public.emp_mstr.emp_work_group,
            public.emp_mstr.emp_hirarki,
            public.emp_mstr.emp_npwp,
            public.emp_mstr.emp_nama_klrg_dekat,
            public.emp_mstr.emp_klrg_dekat_hub,
            public.emp_mstr.emp_telp_klrg_dekat,
            public.emp_mstr.emp_email_alt,
            public.emp_mstr.emp_jabatan,
            public.emp_mstr.emp_pot_makan,
            public.emp_mstr.emp_bank,
            public.emp_mstr.emp_t_jabatan,
            public.emp_mstr.emp_persnlt_code_id,
            public.emp_mstr.emp_bpjs,
            public.en_mstr.*,
            hris.hrjabatan_mstr.*,
            public.code_mstr.code_name,
            public.code_mstr.code_code
            "))
            ->leftJoin('public.en_mstr', 'public.en_mstr.en_id', '=', 'public.emp_mstr.emp_en_id')
            ->leftJoin('hris.hrjabatan_mstr', 'hris.hrjabatan_mstr.hrjbt_id', '=', 'public.emp_mstr.emp_jabatan')
            ->leftJoin('public.code_mstr', 'public.code_mstr.code_id', '=', 'public.emp_mstr.emp_status_marital')
            ->where('public.emp_mstr.emp_id', '=', $emp_id)->first();

            $data->hirarki = DB::table('public.emp_mstr')->where('emp_id', $data->emp_hirarki)->first(['emp_fname', 'emp_mname', 'emp_lname', 'emp_id']);
            $data->hrGol = DB::table('hris.hrgol_mstr')->where('hrgol_id', $data->emp_hrgol_id)->first(['hrgol_name', 'hrgol_id', 'hrgol_active']);
            $data->hrPos = DB::table('hris.hrpos_mstr')->where('hrpos_id', $data->emp_hrpos_id)->first(['hrpos_id', 'hrpos_name', 'hrpos_code', 'hrpos_active']);
            $data->pangkat = DB::table('hris.pangkat_mstr')->where('pangkat_id', $data->emp_pangkat_id)->first(['pangkat_id', 'pangkat_code', 'pangkat_name', 'pangkat_active']);
            $data->personality = DB::table('public.code_mstr')->where('code_id', $data->emp_persnlt_code_id)->first(['code_id', 'code_name', 'code_code', 'code_desc']);

            $rawPhoto = DB::table('public.emp_mstr')->select(DB::raw("encode(public.emp_mstr.emp_photo, 'base64') AS emp_photo"))
            ->where('public.emp_mstr.emp_id', '=', $emp_id)
            ->first();

            $photo = base64_decode($rawPhoto->emp_photo);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'data' => $data,
                'photo' => $photo,
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
            $name = explode(' ', $request->namaLengkap);

            $count = count($name) - 1;

            $employee = EmpMaster::where('emp_id', $emp_id)->first();

            EmpMaster::where('emp_id', $emp_id)->update([
                'emp_upd_by' => Auth::user()->usernama, //done
                'emp_upd_date' => Carbon::translateTimeString(now()), //done //done
                'emp_fname' => ($name[0]) ? $name[0] : $employee->emp_fname, //done
                'emp_mname' => ($request->namaPanggilan) ? $request->namaPanggilan : $employee->emp_mname, //done
                'emp_lname' => ($count > 0) ? $name[$count] : $employee->emp_lname, //done
                'emp_gender' => ($request->gender) ? $request->gender : $employee->emp_gender, //done
                'emp_birth_date' => ($request->tglLahir) ? $request->tglLahir : $employee->emp_birth_date, //done
                'emp_birth_place' => ($request->tmptLahir) ? $request->tmptLahir : $employee->emp_birth_place, //done
                'emp_area_id' => ($request->areaId) ? $request->areaId : $employee->emp_area_id, //done
                'emp_no_ktp' => ($request->noKtp) ? $request->noKtp : $employee->emp_no_ktp, //done
                'emp_pin' => ($request->pin) ? $request->pin : $employee->emp_pin, //done
                // 'emp_tinggi_badan' => $request->tinggiBadan, //done
                // 'emp_berat_badan' => $request->beratBadan, //done
                // 'emp_penyakit' => $request->penyakit,
                // 'emp_cacat' => $request->cacat,
                'emp_telp_rumah' => ($request->tlpRumah) ? $request->telpRumah : $employee->emp_telp_rumah, //done
                'emp_telp_alt' => ($request->telp2) ? $request->telp2 : $employee->emp_telp_alt, //done
                'emp_hp' => ($request->hp) ? $request->hp : $employee->emp_hp, //done
                'emp_email' => ($request->email) ? $request->email : $employee->emp_email, //done
                // 'emp_website' => $request->web, //done
                'emp_inisial' => ($request->inisial) ? $request->inisial : $employee->emp_inisial, //done
                'emp_tgl_masuk' => ($request->tglMasuk) ? $request->thlMasuk : $employee->emp_tgl_masuk,
                'emp_hrgol_id' => ($request->hrGolId) ? $request->hrGolId : $employee->emp_hrgol_id,
                'emp_hrpos_id' => ($request->hrPosId) ? $request->hrPosId : $employee->emp_hrpos_id,
                'emp_pangkat_id' => ($request->PangkatId) ? $request->PangkatId : $employee->emp_pangkat_id,
                'emp_status_koperasi' => ($request->statKoperasi) ? $request->statKoperasi : $employee->emp_status_koperasi,
                'emp_active' => ($request->active) ? $request->active : $employee->emp_active,
                'emp_finger' => ($request->finger) ? $request->finger : $employee->emp_finger,
                'emp_hrstatus_id' => ($request->hrStatusId) ? $request->hrStatusId : $employee->emp_hrstatus_id,
                'emp_tgl_keluar' => ($request->tglKeluar) ? $request->tglKeluar : $employee->emp_tgl_keluar,
                'emp_alasan_keluar' => ($request->alasanKeluar) ? $request->alasanKeluar : $employee->emp_alasan_keluar,
                'emp_address' => ($request->address) ? $request->address : $employee->emp_address,
                'emp_photo' => ($request->photo) ? $request->photo : $employee->emp_photo,
                // 'emp_type' => $request->type,
                'emp_kota' => ($request->kota) ? $request->kota : $employee->emp_kota,
                'emp_propinsi' => ($request->propinsi) ? $request->propinsi : $employee->emp_propinsi,
                'emp_kd_pos' => ($request->kodePos) ? $request->kodePos : $employee->emp_kd_pos,
                'emp_en_id' => ($request->enId) ? $request->enId : $employee->emp_en_id,
                'emp_status_marital' => ($request->statMarital) ? $request->statMarital : $employee->emp_status_marital,
                'emp_no_rek' => ($request->noRek) ? $request->noRek : $employee->emp_no_rek,
                'emp_id_finger' => ($request->idFinger) ? $request->idFinger : $employee->emp_id_finger,
                // 'emp_gaji_pokok' => $request->gajiPokok,
                // 'emp_t_transport' => $request->tTransport,
                'emp_work_group' => ($request->workGroup) ? $request->workGroup : $employee->emp_work_group,
                'emp_privilege_finger' => ($request->privilegeFinger) ? $request->privilegeFinger : $employee->emp_privilege_finger,
                'emp_password_finger' => ($request->passwordFinger) ? $request->passwordFinger : $employee->emp_password_finger,
                'emp_no_urut' => ($request->noUrut) ? $request->noUrut : $employee->emp_no_urut,
                'emp_hirarki' => ($request->hirarki) ? $request->hirarki : $employee->emp_hirarki,
                'emp_npwp' => ($request->npwp) ? $request->npwp : $employee->emp_npwp,
                'emp_email_alt' => ($request->emailAlt) ? $request->emailAlt : $employee->emp_email_alt,
                'emp_jabatan' => ($request->jabatanId) ? $request->jabatanId : $employee->emp_jabatan,
                'emp_bpjs' => ($request->bpjs) ? $request->bpjs : $employee->emp_bpjs
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengupdate data',
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengupdate data',
                'galat' => $th->getMessage(),
                'line' => $th->getLine(),
                'path' => $th->getFile(),
                'code' => 400
            ], 400);
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
