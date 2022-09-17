<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmpMaster;
use App\Models\HRSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiseaseController extends Controller
{
    public function show($emp_id)
    {
        try {
            $data = HRSakit::where('hrsakit_emp_id', $emp_id)->get();

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
            $sequence = HRSakit::where('hrsakit_emp_id', $request->emp_id)->count();

            if (!$sequence) {
                $sequence = 1;
            } elseif ($sequence = 5) {
                return response()->json([
                    'status' => 'gagal',
                    'pesan' => 'input sudah mencapai limit',
                    'limit' => 5,
                    'code' => 300
                ], 300);
            }

            $data = HRSakit::create([
                'hrsakit_oid' => Str::uuid(),
                'hrsakit_emp_id' => $request->emp_id,
                'hrsakit_jenis' => $request->jenis,
                'hrsakit_lama' => $request->lama,
                'hrsakit_tahun' => $request->tahun,
                'hrsakit_kondisi' => $request->kondisi,
                'hrsakit_seq' => $sequence
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menambahkan data sakit & cacat',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menambahkan data sakit & cacat',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }
}
