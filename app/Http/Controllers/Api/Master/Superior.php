<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use App\Models\EmpMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Superior extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($jabatan_id, $pangkat_id)
    {
        // dd('hello world');

        try {
            // $data = EmpMaster::where([
            //     ['emp_jabatan', '=', $jabatan_id],
            //     ['emp_pangkat_id', '=', $pangkat_id]
            // ])->get()

            $data = DB::table('public.emp_mstr')
                ->select(DB::raw('emp_fname, emp_mname, emp_lname, emp_id'))
                ->where([
                    ['emp_jabatan', '=', $jabatan_id],
                    ['emp_pangkat_id', '=', $pangkat_id]
                ])->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data atasan',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data atasan',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }
}
