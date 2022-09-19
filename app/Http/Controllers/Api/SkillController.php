<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRKeahlian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillController extends Controller
{
    public function show($emp_id)
    {
        try {
            $data = HRKeahlian::where('hrahli_emp_id', $emp_id)->get();

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
            $total = HRKeahlian::where('hrahli_emp_id', $request->emp_id)->count();

            if ($total == 5) {
                return response()->json([
                    'status' => 'redirected',
                    'pesan' => 'input sudah melebihi limit!',
                    'limit' => 5,
                    'code' => 300
                ], 300);
            }

            $skill = HRKeahlian::create([
                'hrahli_oid' => Str::uuid(),
                'hrahli_emp_id' => $request->emp_id,
                'hrahli_jenis_keahlian' => $request->jenisKeahlian,
                'hrahli_tingkat' => $request->tingkatKeahlian,
                'hrahli_prestasi' => $request->prestasiKeahlian
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil inputkan data',
                'skill' => $skill,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal inputkan data',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }
}
