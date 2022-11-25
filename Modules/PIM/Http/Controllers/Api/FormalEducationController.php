<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\PIM\Entities\HRPendidikan;

class FormalEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $sequence = HRPendidikan::where('hrpend_emp_id', $request->emp_id)->count();

            if (!$sequence) {
                $sequence = 1;
            } elseif ($sequence == 5) {
                return response()->json([
                    'status' => 'redirected',
                    'pesan' => 'input sudah melebihi limit!',
                    'limit' => 5,
                    'code' => 300
                ], 300);
            } else {
                $sequence++;
            }

            $pendidikanFormal = HRPendidikan::create([
                'hrpend_oid' => Str::uuid(),
                'hrpend_emp_id' => $request->emp_id,
                'hrpend_seq' => $sequence,
                'hrpend_jenjang' => $request->jenjangPendidikanFormal,
                'hrpend_lembaga' => $request->lembagaPendidikanFormal,
                'hrpend_jurusan' => $request->jurusanPendidikanFormal,
                'hrpend_start' => $request->thnAwalPendidikanFormal,
                'hrpend_end' => $request->thnAkhirPendidikanFormal,
                'hrpend_prestasi' => $request->prestasiPendidikanFormal
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menginputkan data',
                'data' => $pendidikanFormal,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menginputkan data',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($emp_id)
    {
        try {
            $data = DB::table('hris.hr_pendidikan')
            ->select(DB::raw('hris.hr_pendidikan.*'))
            ->where('hrpend_emp_id', '=', $emp_id)->orderBy('hrpend_seq', 'ASC')->get();

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
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, HRPendidikan $hrPendidikan)
    {
        try {
            $hrPendidikan->update([
                'hrpend_jenjang' => ($request->jenjangPendidikanFormal) ? $request->jenjangPendidikanFormal : $hrPendidikan->hrpend_jenjang,
                'hrpend_lembaga' => ($request->lembagaPendidikanFormal) ? $request->lembagaPendidikanFormal : $hrPendidikan->hrpend_lembaga,
                'hrpend_jurusan' => ($request->jurusanPendidikanFormal) ? $request->jurusanPendidikanFormal : $hrPendidikan->hrpend_jurusan,
                'hrpend_start' => ($request->thnAwalPendidikanFormal) ? $request->thnAwalPendidikanFormal : $hrPendidikan->hrpend_start,
                'hrpend_end' => ($request->thnAkhirPendidikanFormal) ? $request->thnAkhirPendidikanFormal : $hrPendidikan->hrpend_end,
                'hrpend_prestasi' => ($request->prestasiPendidikanFormal) ? $request->prestasiPendidikanFormal : $hrPendidikan->hrpend_prestasi
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil update data',
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal update data',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
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
