<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PengajuanRequest;
use App\Models\{RekrutPengajuan, DptMstr};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = RekrutPengajuan::get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengajuanRequest $request)
    {
        $count = RekrutPengajuan::count();
        ($count >= 1) ? $count++ : $count = 1;

        $base = '000';

        $funcAttachement = array_slice(str_split($base), 0, -strlen($count));
        $totalAttachement = implode($funcAttachement).$count;

        $funcDept = array_slice(str_split($base), 0, -strlen($request->recruitementDivisi));
        $departement = implode($funcDept).$request->recruitementDivisi;

        $pengajuan_code = 'PGJ-'.Carbon::now()->format('ym').$departement.$totalAttachement;
        // dd($request->all());

        try {
            DB::beginTransaction();

            if ($request->recruitmentJmlPria != NULL) {
                $data['pria'] = RekrutPengajuan::create([
                    'pgj_code' => $pengajuan_code,
                    'pgj_date' => Carbon::translateTimeString(now()),
                    'pgj_nomor_telepon' => $request->recruitmentNoWhatsapp,
                    'pgj_alasan' => $request->recruitmentAlasan,
                    'pgj_tipe_alasan' => $request->recruitmentTypeAlasan,
                    'pgj_en_id' => $request->recruitmentEntitas,
                    'pgj_status_karyawan' => $request->recruitmentStatus,
                    'pgj_tipe_rekrutmen' => $request->recruitmentType,
                    'pgj_pangkat' => $request->recruitmentLevel,
                    'pgj_jabatan' => $request->recruitmentJabatan,
                    'pgj_posisi' => $request->recruitmentPosisi,
                    'pgj_jumlah' => $request->recruitmentJmlPria,
                    'pgj_jenis_kelamin' => 'L',
                    'pgj_lokasi' => $request->recruitmentLokasi,
                    // 'pgj_hirarki' => $request->atasan_id,
                    'pgj_pendidikan' => $request->recruitmentTingkatPendidikan,
                    'pgj_jurusan' => $request->recruitmentJurusan,
                    'pgj_pengalaman' => $request->recruitmentPengalaman,
                    'pgj_pengetahuan_dan_keahlian' => $request->recruitmentPengetahuanDanKeahlian,
                    'pgj_deskripsi_pekerjaan' => $request->recruitmentDeskripsi,
                    'pgj_tgl_terpenuhi' => $request->recruitmentEkspektasiJoin
                ]);
            }

            if ($request->recruitmentJmlWanita != NULL) {
                $data['wanita'] = RekrutPengajuan::create([
                    'pgj_code' => $pengajuan_code,
                    'pgj_date' => Carbon::translateTimeString(now()),
                    'pgj_nomor_telepon' => $request->recruitmentNoWhatsapp,
                    'pgj_alasan' => $request->recruitmentAlasan,
                    'pgj_tipe_alasan' => $request->recruitmentTypeAlasan,
                    'pgj_en_id' => $request->recruitmentEntitas,
                    'pgj_status_karyawan' => $request->recruitmentStatus,
                    'pgj_tipe_rekrutmen' => $request->recruitmentType,
                    'pgj_pangkat' => $request->recruitmentLevel,
                    'pgj_jabatan' => $request->recruitmentJabatan,
                    'pgj_posisi' => $request->recruitmentPosisi,
                    'pgj_jumlah' => $request->recruitmentJmlWanita,
                    'pgj_jenis_kelamin' => 'P',
                    'pgj_lokasi' => $request->recruitmentLokasi,
                    // 'pgj_hirarki' => $request->atasan_id,
                    'pgj_pendidikan' => $request->recruitmentTingkatPendidikan,
                    'pgj_jurusan' => $request->recruitmentJurusan,
                    'pgj_pengalaman' => $request->recruitmentPengalaman,
                    'pgj_pengetahuan_dan_keahlian' => $request->recruitmentPengetahuanDanKeahlian,
                    'pgj_deskripsi_pekerjaan' => $request->recruitmentDeskripsi,
                    'pgj_tgl_terpenuhi' => $request->recruitmentEkspektasiJoin
                ]);
            }

        DB::commit();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengajukan SDM baru',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengajukan SDM baru',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RekrutPengajuan  $rekrutPengajuan
     * @return \Illuminate\Http\Response
     */
    public function show(RekrutPengajuan $rekrutPengajuan)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RekrutPengajuan  $rekrutPengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RekrutPengajuan $rekrutPengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RekrutPengajuan  $rekrutPengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RekrutPengajuan $rekrutPengajuan)
    {
        //
    }
}
