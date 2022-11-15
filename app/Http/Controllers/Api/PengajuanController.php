<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PengajuanRequest;
use App\Models\{RekrutPengajuan, DptMstr};
use Carbon\Carbon;

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
        dd($pengajuan_code);

        try {
            $data = RekrutPengajuan::create([
                'pgj_code' => $pengajuan_code,
                'pgj_date' => Carbon::translateTimeString(now()),
                'pgj_alasan' => $request->alasan,
                'pgj_en_id' => $request->en_id,
                'pgj_status_karyawan' => $request->status,
                'pgj_jumlah' => $request->jumlah,
                'pgj_pendidikan' => $request->tingkat_pendidikan,
                'pgj_jurusan' => $request->jurusan,
                'pengalaman' => $request->pengalaman,
                'pgj_tgl_terpenuhi' => $request->ekspetasi_join,
                'pgj_level' => $request->level,
                'pgj_hirarki' => $request->atasan_id,
                'pgj_jenis_kelamin' => 'L'
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengajukan SDM baru',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
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
