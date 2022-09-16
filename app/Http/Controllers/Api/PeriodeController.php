<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRPeriodeMaster;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PeriodeController extends Controller
{
    public function index()
    {
        try {
            $data = HRPeriodeMaster::get();

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
            $data = HRPeriodeMaster::create([
                'hrperiode_add_by' => Auth::user()->usernama,
                'hrperiode_add_date' => Carbon::translateTimeString(now()),
                'hrperiode_code' => $request->periodeCode,
                'hrperiode_start_date' => $request->startDate,
                'hrperiode_end_date' => $request->endDate,
                'hrperiode_status' => $request->status,
                'hrperiode_dt' => Carbon::translateTimeString(now()),
                'hrperiode_bulan_code' => $request->bulanCode,
                'tahun' => $request->tahun,
                'hrperiode_active' => $request->active
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat periode',
                'periode' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal membuat periode',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }
}
