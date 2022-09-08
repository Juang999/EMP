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
            // dd($photo);

            $employee = EmpMaster::create([
                'emp_add_by' => Auth::user()->usernama,
                'emp_add_date' => Carbon::now(),
                'emp_id' => $emp_id,
                'emp_fname' => $name[0],
                'emp_mname' => ($name[1]) ? $name[1] : '-',
                'emp_lname' => ($name[2]) ? $name[2] : '-',
                'emp_gender' => $request->gender,
                'emp_pos_id' => $request->PosId,
                'emp_dt' => Carbon::now(),
                'emp_birth_date' => $request->birthDate,
                'emp_birth_place' => $request->birthPlace,
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
                'emp_hrpangkat_id' => $request->hrPangkatId,
                'emp_status_koperasi' => $request->statKoperasi,
                'emp_active' => $request->active,
                'emp_finger' => $request->finger,
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
                // 'emp_id_finger' => $request->idFinger,
                // 'emp_work_group' => $request->workGroup,
                'emp_gaji_pokok' => $request->gajiPokok,
                'emp_t_transport' => $request->tTransport,
                'emp_t_perumahan' => $request->tPerumahan,
                'emp_t_bbm' => $request->tBbm,
                'emp_t_telepon' => $request->tTelepon,
                'emp_t_makan' => $request->tMakan,
                'emp_t_fungsional' => $request->tFungsional,
                'emp_upah_perjam_borongan' => $request->upahKerjaBorongan,
                // 'emp_privilege_finger' => $request->privilegeFInger,
                // 'emp_password_finger' => $request->passwordFinger,
                // 'emp_no_urut' => $request->noUrut,
                'emp_hirarki' => $request->hirarki,
                'emp_npwp' => $request->npwp,
                'emp_nama_klrg_dekat' => $request->namaKlrgDekat,
                'emp_klrg_dekat_hub' => $request->klrgDekatHub,
                'emp_email_alt' => $request->emailAlt,
                'emp_jabatan' => $request->jabatan,
                'emp_foto' => $request->foto,
                'emp_pot_makan' => $request->potMakan,
                'emp_bank' => $request->bank,
                'emp_t_jabatan' => $request->tJabatan,
                'emp_kota_umk' => $request->kotaUmk,
                'emp_pot_bpjs' => $request->potBpjs,
                'emp_t_kepangkatan' => $request->tKepangkatan,
                'emp_pot_zakat' => $request->potZakat,
                'emp_zis' => $request->zis
            ]);

            $keluarga = DB::table('hris.hr_keluarga')->insert([
                'hrkel_emp_id' => $employee['emp_oid'],
                'hrkel_hub_id' => $request->hub_id,
                'hrkel_nama' => $request->nama,
                'hrkel_remarks' => $request->remarks,
                'hrkel_tgl_lahir' => $request->tglLahir,
                'hrkel_tempat_lahir' => $request->tempatLahir
            ]);

            $keahlian = DB::table('hris.hr_keahlian')->insert([
                'hrahli_emp_id' => $employee['emp_oid'],
                'hrahli_jenis_keahlian' => $request->jenisKeahlian,
                'hrahli_tingkat' => $request->tingkat,
                ''
            ]);

            $useraset = DB::table('use_aset')->insert([
                //
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
