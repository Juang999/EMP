<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRPendidikanNon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NonFormalEducationController extends Controller
{
    public function index($emp_id)
    {
        try {
            $data = HRPendidikanNon::where('hrpendn_emp_id', $emp_id)->orderBy('hrpendn_seq')->get();

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
            $sequence = HRPendidikanNon::where('hrpendn_emp_id', $request->emp_id)->count();

            if (!$sequence) {
                $sequence = 1;
            } elseif ($sequence == 5) {
                return response()->json([
                    'status' => 'redirected',
                    'pesan' => 'input sudah melebihi limit!',
                    'limit' => 5
                ], 300);
            } else {
                $sequence++;
            }

            $pendidikanNonFormal = HRPendidikanNon::create([
                'hrpendn_oid' => Str::uuid(),
                'hrpendn_emp_id' => $request->emp_id,
                'hrpendn_seq' => $sequence,
                'hrpendn_lembaga' => $request->lembaga,
                'hrpendn_keterangan' => $request->keterangan,
                'hrpendn_start' => $request->start,
                'hrpendn_end' => $request->end,
                'hrpendn_jns_pendidikan' => $request->jnsPendidikan,
                'hrpendn_prestasi' => $request->prestasi
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil inputkan data pendidikan non formal',
                'data' => $pendidikanNonFormal
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal inputkan data pendidikan non formal',
                'galat' => $th->getMessage()
            ], 400);
        }
    }
}
