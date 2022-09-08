<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnMaster;

class En extends Controller
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
            $entitas = EnMaster::get();

            return response()->json([
                'code' => 200,
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data entitas',
                'entitas' => $entitas
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data entitas',
                'galat' => $th->getMessage()
            ], 400);
        }
    }
}
