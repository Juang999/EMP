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

        $funcDept = array_slice(str_split($base), 0, -strlen($request->dpt_id));
        $departement = implode($funcDept).$request->dpt_id;

        $pengajuan_code = 'PGJ-'.Carbon::now()->format('ym').$departement.$totalAttachement;
        // dd($request->all());

        try {
            DB::beginTransaction();

            if ($request->jumlah_pria != NULL) {
                $data['pria'] = RekrutPengajuan::create([
                    'pgj_code' => $pengajuan_code,
                    'pgj_date' => Carbon::translateTimeString(now()),
                    'pgj_nomor_telepon' => $request->nomor_telepon,
                    'pgj_alasan' => $request->alasan,
                    'pgj_tipe_alasan' => $request->tipe_alasan,
                    'pgj_en_id' => $request->en_id,
                    'pgj_status_karyawan' => $request->status,
                    'pgj_tipe_rekrutmen' => $request->tipe_rekrutmen,
                    'pgj_pangkat' => $request->level,
                    'pgj_jabatan' => $request->jabatan,
                    'pgj_posisi' => $request->posisi,
                    'pgj_jumlah' => $request->jumlah_pria,
                    'pgj_jenis_kelamin' => 'L',
                    'pgj_lokasi' => $request->lokasi,
                    'pgj_hirarki' => $request->atasan_id,
                    'pgj_pendidikan' => $request->tingkat_pendidikan,
                    'pgj_jurusan' => $request->jurusan,
                    'pgj_pengalaman' => $request->pengalaman,
                    'pgj_pengetahuan_dan_keahlian' => $request->pengetahuan_dan_keahlian,
                    'pgj_deskripsi_pekerjaan' => $request->deksripsi_pekerjaan,
                    'pgj_tgl_terpenuhi' => $request->ekspetasi_join
                ]);
            }

            if ($request->jumlah_wanita != NULL) {
                $data['wanita'] = RekrutPengajuan::create([
                    'pgj_code' => $pengajuan_code,
                    'pgj_date' => Carbon::translateTimeString(now()),
                    'pgj_nomor_telepon' => $request->nomor_telepon,
                    'pgj_alasan' => $request->alasan,
                    'pgj_tipe_alasan' => $request->tipe_alasan,
                    'pgj_en_id' => $request->en_id,
                    'pgj_status_karyawan' => $request->status,
                    'pgj_tipe_rekrutmen' => $request->tipe_rekrutmen,
                    'pgj_pangkat' => $request->level,
                    'pgj_jabatan' => $request->jabatan,
                    'pgj_posisi' => $request->posisi,
                    'pgj_jumlah' => $request->jumlah_wanita,
                    'pgj_jenis_kelamin' => 'P',
                    'pgj_lokasi' => $request->lokasi,
                    'pgj_hirarki' => $request->atasan_id,
                    'pgj_pendidikan' => $request->tingkat_pendidikan,
                    'pgj_jurusan' => $request->jurusan,
                    'pgj_pengalaman' => $request->pengalaman,
                    'pgj_pengetahuan_dan_keahlian' => $request->pengetahuan_dan_keahlian,
                    'pgj_deskripsi_pekerjaan' => $request->deksripsi_pekerjaan,
                    'pgj_tgl_terpenuhi' => $request->ekspetasi_join
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
