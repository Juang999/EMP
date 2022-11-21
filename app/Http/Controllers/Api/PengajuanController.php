<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PengajuanRequest;
use App\Models\{RekrutPengajuan, DptMstr};
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data',
                'galat' => $th->getMessage(),
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
                    'pgj_tgl_terpenuhi' => $request->recruitmentEkspektasiJoin,
                    'pgj_add_by' => Auth::user()->usernama,
                    'pgj_add_date' => Carbon::translateTimeString(now())
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
                    'pgj_tgl_terpenuhi' => $request->recruitmentEkspektasiJoin,
                    'pgj_add_by' => Auth::user()->usernama,
                    'pgj_add_date' => Carbon::translateTimeString(now())
                ]);
            }

        DB::commit();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengajukan SDM baru',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengajukan SDM baru',
                'galat' => $th->getMessage(),
                'code' => 400
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
            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'data' => $rekrutPengajuan,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RekrutPengajuan  $rekrutPengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        try {
            $data = RekrutPengajuan::where('pgj_code', $code)->first();

            dd($data);
            RekrutPengajuan::create([
                'pgj_date' => Carbon::translateTimeString(now()),
                'pgj_nomor_telepon' => ($request->recruitmentNoWhatsapp) ? $request->recruitmentNoWhatsapp : $data->pgj_nomor_telepon,
                'pgj_alasan' => ($request->recruitmentAlasan) ? $request->recruitmentAlasan : $data->pgj_alasan,
                'pgj_tipe_alasan' => ($request->recruitmentTypeAlasan) ? $request->recruitmentTypeAlasan : $data->pgj_tipe_alasan,
                'pgj_en_id' => ($request->recruitmentEntitas) ? $request->recruitmentEntitas : $data->pgj_en_id,
                'pgj_status_karyawan' => ($request->recruitmentStatus) ? $request->recruitmentStatus : $data->pgj_status_karyawan,
                'pgj_tipe_rekrutmen' => ($request->recruitmentType) ? $request->recruitmentType : $data->pgj_tipe_rekrutmen,
                'pgj_pangkat' => ($request->recruitmentLevel) ? $request->recruitmentLevel : $data->pgj_pangkat,
                'pgj_jabatan' => ($request->recruitmentJabatan) ? $request->recruitmentJabatan : $data->pgj_jabatan,
                'pgj_posisi' => ($request->recruitmentPosisi) ? $request->recruitmentPosisi : $data->pgj_posisi,
                'pgj_jumlah' => ($request->recruitmentJmlWanita) ? $request->recruitmentJmlWanita : $data->pgj_jumlah,
                'pgj_lokasi' => ($request->recruitmentLokasi) ? $request->recruitmentLokasi : $data->pgj_lokasi,
                // 'pgj_hirarki' => ($request->atasan_id) ? $request->atasan_id : $data->pgj_hirarki,
                'pgj_pendidikan' => ($request->recruitmentTingkatPendidikan) ? $request->recruitmentTingkatPendidikan : $data->pgj_pendidikan,
                'pgj_jurusan' => ($request->recruitmentJurusan) ? $request->recruitmentJurusan : $data->pgj_jurusan,
                'pgj_pengalaman' => ($request->recruitmentPengalaman) ? $request->recruitmentPengalaman : $data->pgj_pengalaman,
                'pgj_pengetahuan_dan_keahlian' => ($request->recruitmentPengetahuanDanKeahlian) ? $request->recruitmentPengetahuanDanKeahlian : $data->pgj_pengetahuan_dan_keahlian,
                'pgj_deskripsi_pekerjaan' => ($request->recruitmentDeskripsi) ? $request->recruitmentDeskripsi : $data->pgj_deskripsi_pekerjaan,
                'pgj_tgl_terpenuhi' => ($request->recruitmentEkspektasiJoin) ? $request->recruitmentEkspektasiJoin : $data->pgj_tgl_terpenuhi,
                'pgj_upd_by' => Auth::user()->usernama,
                'pgj_upd_date' => Carbon::translateTimeString(now())
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'data' => true,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
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
