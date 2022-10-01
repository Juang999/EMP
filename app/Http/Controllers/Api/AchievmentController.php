<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRPrestasi;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function PHPSTORM_META\map;

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
            } elseif ($sequence == 5) {
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
                'hrpres_prestasi' => $request->prestasiPrestasi,
                'hrpres_lembaga' => $request->lembagaPrestasi,
                'hrpres_ket' => $request->keteranganPrestasi,
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

    public function update(Request $request, $hrpres_oid)
    {
        try {
            $employee = HRPrestasi::where('hrpres_oid', $hrpres_oid)->first();

            HRPrestasi::where('hrpres_oid', $hrpres_oid)->update([
                'hrpres_prestasi' => ($request->prestasiPrestasi) ? $request->prestasiPrestasi : $employee->hrpres_prestasi,
                'hrpres_lembaga' => ($request->lembagaPrestasi) ? $request->lembagaPrestasi : $employee->hrpres_lembaga,
                'hrpres_ket' => ($request->keteranganPrestasi) ? $request->keteranganPrestasi : $employee->hrpres_ket,
                'hrpres_tahun' => ($request->tahunPrestasi) ? $request->tahunPrestasi : $employee->hrpres_tahun
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
                'line' => $th->getLine(),
                'file' => $th->getFile(),
                'code' => 400
            ], 400);
        }
    }
}
