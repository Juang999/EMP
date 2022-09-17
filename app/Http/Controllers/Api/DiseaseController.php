<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmpMaster;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    public function show($emp_id)
    {
        try {
            $data = EmpMaster::where('emp_id', $emp_id)->first(['emp_penyakit', 'emp_cacat']);

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
            EmpMaster::where('emp_id', $request->emp_id)->update([
                'emp_penyakit' => $request->sakit,
                'emp_cacat' => $request->cacat
            ]);

            $data = EmpMaster::where('emp_id', $request->emp_id)->first(['emp_id', 'emp_penyakit', 'emp_cacat']);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menambahkan data sakit & cacat',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menambahkan data sakit & cacat',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }
}
