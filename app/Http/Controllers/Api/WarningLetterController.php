<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRMasaSP;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class WarningLetterController extends Controller
{
    public function show($emp_id)
    {
        try {
            // $data = HRMasaSP::where('hrsp_emp_id', $emp_id)->get();

            $data = DB::table('hris.hr_masa_sp')
                ->select(DB::raw('hris.hr_masa_sp.*, hris.hrperiode_mstr.*'))
                ->join('hris.hrperiode_mstr', 'hris.hr_masa_sp.hrsp_start_periode', '=', 'hris.hrperiode_mstr.hrperiode_code')
                ->get();

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
        $total = HRMasaSP::where('hrsp_emp_id', $request->emp_id)->count();

        if ($total == 5) {
            return response()->json([
                'status' => 'redirected',
                'pesan' => 'kamu sudah mencapai limit',
                'limit' => 5,
                'code' => 300
            ], 300);
        }

        // dd($request->all());
        try {
            $data = HRMasaSP::create([
                'hrsp_oid' => Str::uuid(),
                'hrsp_emp_id' => $request->emp_id,
                'hrsp_sp' => $request->sp,
                'hrsp_desc' => $request->descSP,
                'hrsp_start_periode' => $request->startSP,
                'hrsp_end_periode' => $request->endSP
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menginputkan data',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menginputkan data',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }
}
