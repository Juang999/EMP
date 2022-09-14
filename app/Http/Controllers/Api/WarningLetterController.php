<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRMasaSP;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WarningLetterController extends Controller
{
    public function index($emp_id)
    {
        try {
            $data = HRMasaSP::where('hrsp_emp_id', $emp_id)->get();

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
        $total = HRMasaSP::where('hrsp_emp_id', $request->emp_id)->count();

        if ($total == 5) {
            return response()->json([
                'status' => 'redirected',
                'pesan' => 'kamu sudah mencapai limit',
                'limit' => 5
            ], 300);
        }

        // dd($request->all());
        try {
            $data = HRMasaSP::create([
                'hrsp_oid' => Str::uuid(),
                'hrsp_sp' => $request->sp,
                'hrsp_desc' => $request->desc,
                'hrsp_start_periode' => $request->start,
                'hrsp_end_periode' => $request->end
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menginputkan data',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menginputkan data',
                'galat' => $th->getMessage()
            ], 400);
        }
    }
}
