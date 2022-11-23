<?php

namespace App\Http\Controllers\Api\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CodeMaster;

class RecruitmentType extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        try {
            $data = CodeMaster::where('code_field', 'recruitment_type')->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data rekrutmen',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data rekrutmen',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }
}
