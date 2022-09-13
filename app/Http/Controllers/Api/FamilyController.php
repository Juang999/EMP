<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRKeluarga;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class FamilyController extends Controller
{
    public function index($emp_id)
    {
        try {
            $data = HRKeluarga::where('hrkel_emp_id', $emp_id)->get();

            return response()->json([
                'status' => 'success',
                'message' => 'success to get data',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to get data',
                'error' => $th->getMessage()
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $sequence = HRKeluarga::where('hrkel_emp_id', $request->emp_id)->count();

            if (!$sequence) {
                $sequence = 1;
            } else {
                $sequence++;
            }

            $family = HRKeluarga::create([
                'hrkel_oid' => Str::uuid(),
                'hrkel_emp_id' => $request->emp_id,
                'hrkel_seq' => $sequence,
                'hrkel_hub_id' => $request->hubId,
                'hrkel_nama' => $request->nama,
                'hrkel_tgl_lahir' => $request->tglLahir,
                'hrkel_tempat_lahir' => $request->tmptLahir
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat data keluarga',
                'data' => $family
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal membuat data keluarga',
                'galat' => $th->getMessage()
            ], 400);
        }
    }
}
