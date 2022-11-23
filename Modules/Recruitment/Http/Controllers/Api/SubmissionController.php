<?php

namespace Modules\Recruitment\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Recruitment\Entities\RekrutPengajuan;
use Modules\Recruitment\Http\Requests\SubmissionRequest;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
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
     * @param Request $request
     * @return Response
     */
    public function store(SubmissionRequest $request)
    {
        try {
            $count = RekrutPengajuan::count();
            ($count >= 1) ? $count++ : $count = 1;

            $base = '000';

            $funcAttachement = array_slice(str_split($base), 0, -strlen($count));
            $totalAttachement = implode($funcAttachement).$count;

            $funcDept = array_slice(str_split($base), 0, -strlen($request->recruitmentDivisi));
            $departement = implode($funcDept).$request->recruitmentDivisi;

            $pengajuan_code = 'PGJ-'.Carbon::now()->format('ym').$departement.$totalAttachement;


            $data = RekrutPengajuan::create([
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
                'pgj_lokasi' => $request->recruitmentLokasi,
                'pgj_atasan' => $request->atasan_id,
                'pgj_pendidikan' => $request->recruitmentTingkatPendidikan,
                'pgj_jurusan' => $request->recruitmentJurusan,
                'pgj_pengalaman' => $request->recruitmentPengalaman,
                'pgj_pengetahuan_dan_keahlian' => $request->recruitmentPengetahuanDanKeahlian,
                'pgj_deskripsi_pekerjaan' => $request->recruitmentDeskripsi,
                'pgj_tgl_terpenuhi' => $request->recruitmentEkspektasiJoin,
                'pgj_add_by' => Auth::user()->usernama,
                'pgj_add_date' => Carbon::translateTimeString(now()),
                'pgj_male' => ($request->recruitmentJmlPria) ? $request->recruitmentJmlPria : 0,
                'pgj_female' => ($request->recruitmentJmlWanita) ? $request->recruitmentJmlWanita : 0,
                'pgj_nama_pengaju' => $request->recruitmentNamaPengaju
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat pengajuan',
                'pengajuan' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal membuat pengajuan',
                'galat' => $th->getMessage(),
                'line' => $th->getLine(),
                'code' => 400
            ], 400);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
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
                'line' => $th->getLine(),
                'code' => 400
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
