<?php

namespace App\Http\Controllers;

use App\Models\HRPeriodeMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeriodeController extends Controller
{
    public function index()
    {
        //
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
                'periode' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal membuat periode',
                'galat' => $th->getMessage()
            ], 400);
        }
    }
}
