<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormalEducationController extends Controller
{
    public function show($emp_id)
    {
        try {
            $data = HRPendidikan::where('hrpend_emp_id', $emp_id)->orderBy('hrpend_seq', 'ASC')->get();

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
}
