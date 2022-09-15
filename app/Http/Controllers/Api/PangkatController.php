<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmpMaster;
use Illuminate\Http\Request;
use App\Models\PangkatMaster;

class PangkatController extends Controller
{
    public function index($emp_id)
    {
        try {
            $pangkat = EmpMaster::where('emp_id', $emp_id)->with('PangkatMaster')->first(['emp_id', 'emp_pangkat_id']);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data pangkat',
                'pangkat' => $pangkat
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data pangkat',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            EmpMaster::where('emp_id', $request->emp_id)->update([
                'emp_pangkat_id' => $request->pangkatId
            ]);

            $pangkat = EmpMaster::where('emp_id', $request->emp_id)->with('PangkatMaster')->first('emp_pangkat_id');

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menambahkan pangkat',
                'pangkat' => $pangkat
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menambahkan pangkat',
                'galat' => $th->getMessage()
            ], 400);
        }
    }
}
