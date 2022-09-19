<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRPendidikanNon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NonFormalEducationController extends Controller
{
    public function show($emp_id)
    {
        try {
            $data = HRPendidikanNon::where('hrpendn_emp_id', $emp_id)->orderBy('hrpendn_seq')->get();

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
            $sequence = HRPendidikanNon::where('hrpendn_emp_id', $request->emp_id)->count();

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

            $pendidikanNonFormal = HRPendidikanNon::create([
                'hrpendn_oid' => Str::uuid(),
                'hrpendn_emp_id' => $request->emp_id,
                'hrpendn_seq' => $sequence,
                'hrpendn_lembaga' => $request->lembagaPendidikanNon,
                'hrpendn_keterangan' => $request->keteranganPendidikanNon,
                'hrpendn_start' => $request->startPendidikanNon,
                'hrpendn_end' => $request->endPendidikanNon,
                'hrpendn_jns_pendidikan' => $request->jnsPendidikanNon,
                'hrpendn_prestasi' => $request->prestasiPendidikanNon
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil inputkan data pendidikan non formal',
                'data' => $pendidikanNonFormal,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal inputkan data pendidikan non formal',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }
}
