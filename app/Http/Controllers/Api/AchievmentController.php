<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AchievmentController extends Controller
{
    public function show($emp_id)
    {
        try {
            $data = HRPrestasi::where('hrpres_emp_id', $emp_id)->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data prestasi',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data prestasi',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $sequence = HRPrestasi::where('hrpres_emp_id', $request->emp_id)->count();

            if (!$sequence) {
                $sequence = 1;
            } elseif ($sequence = 5) {
                return response()->json([
                    'status' => 'gagal',
                    'pesan' => 'jumlah input telah mencapai limit',
                    'limit' => 5,
                    'code' => 300
                ], 300);
            } else {
                $sequence++;
            }

            $prestasi = HRPrestasi::create([
                'hrpres_oid' => Str::uuid(),
                'hrpres_emp_id' => $request->emp_id,
                'hrpres_seq' => $sequence,
                'hrpres_lembaga' => $request->lembaga,
                'hrpres_ket' => $request->keterangan,
                'hrpres_tahun' => $request->tahunPrestasi
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menginputkan data prestasi',
                'data' => $prestasi,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menginputkan data prestasi',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }
}
