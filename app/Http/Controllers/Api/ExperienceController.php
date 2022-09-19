<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRPengalaman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExperienceController extends Controller
{
    public function show($emp_id)
    {
        try {
            $data = HRPengalaman::where('hrpeng_emp_id', $emp_id)->orderBy('hrpeng_seq', 'ASC')->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data pengalman',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data pengalaman',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $sequence = HRPengalaman::where('hrpeng_emp_id', $request->emp_id)->count();

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

            $data = HRPengalaman::create([
                'hrpeng_oid' => Str::uuid(),
                'hrpeng_emp_id' => $request->emp_id,
                'hrpeng_seq' => $sequence,
                'hrpeng_perusahaan' => $request->perusahaanPengalaman,
                'hrpeng_jabatan' => $request->jabatanPengalaman,
                'hrpeng_status' => $request->statusPengalaman,
                'hrpeng_start' => $request->startPengalaman,
                'hrpeng_end' => $request->endPengalaman,
                'hrpeng_jns_bisnis' => $request->jnsBisnisPengalaman,
                'hrpeng_masa_jabatan' => $request->masaJabatanPengalaman,
                'hrpeng_jabatan_atasan' => $request->jabatanAtasanPengalaman,
                'hrpeng_jml_bawahan_lgsg' => $request->jmlBawahanLgsgPenglaman,
                'hrpeng_jml_bawahan_total' => $request->jmlBawahanTotalPengalaman
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menginputkan data pengalaman',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menginputkan data pengalaman',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }
}
