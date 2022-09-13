<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormalEducationController extends Controller
{
    public function index($emp_id)
    {
        try {
            $data = HRPendidikan::where('hrpend_emp_id', $emp_id)->get();

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

    public function store(Request $request)
    {
        try {
            $sequence = HRPendidikan::where('hrkel_emp_id', $request->emp_id)->count();

            if (!$sequence) {
                $sequence = 1;
            } else {
                $sequence++;
            }

            $pendidikanFormal = HRPendidikan::create([
                'hrpend_oid' => Str::uuid(),
                'hrpend_emp_id' => $request->emp_id,
                'hrpend_seq' => $sequence,
                'hrpend_jenjang' => $request->jenjang,
                'hrpend_lembaga' => $request->lembaga,
                'hrpend_jurusan' => $request->jurusan,
                'hrpend_start' => $request->start,
                'hrpend_end' => $request->end,
                'hrpend_prestasi' => $request->prestasi
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menginputkan data',
                'data' => $pendidikanFormal
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menginputkan data',
                'galat' => $th->getMessage()
            ], 400);
        }
    }
}
