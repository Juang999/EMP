<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FormalEducationController extends Controller
{
    public function show($emp_id)
    {
        try {
            $data = DB::table('hris.hr_pendidikan')
            ->select(DB::raw('hris.hr_pendidikan.*, hris.hr_pddk_mstr.*'))
            ->join('hris.hr_pddk_mstr', 'hris.hr_pendidikan.hrpend_jenjang', '=', 'hris.hr_pddk_mstr.hrpddk_id')
            ->where('hrpend_emp_id', '=', $emp_id)->orderBy('hrpend_seq', 'ASC')
            ->get();

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

    public function update(Request $request, $oid)
    {
        try {
            $employee = HRPendidikan::where('hrpend_oid', $oid)->first();

            HRPendidikan::where('hrpend_oid', $oid)->update([
                'hrpend_jenjang' => ($request->jenjangPendidikanFormal) ? $request->jenjangPendidikanFormal : $employee->hrpend_jenjang,
                'hrpend_lembaga' => ($request->lembagaPendidikanFormal) ? $request->lembagaPendidikanFormal : $employee->hrpend_lembaga,
                'hrpend_jurusan' => ($request->jurusanPendidikanFormal) ? $request->jurusanPendidikanFormal : $employee->hrpend_jurusan,
                'hrpend_start' => ($request->thnAwalPendidikanFormal) ? $request->thnAwalPendidikanFormal : $employee->hrpend_start,
                'hrpend_end' => ($request->thnAkhirPendidikanFormal) ? $request->thnAkhirPendidikanFormal : $employee->hrpend_end,
                'hrpend_prestasi' => ($request->prestasiPendidikanFormal) ? $request->prestasiPendidikanFormal : $employee->hrpend_prestasi
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
}
