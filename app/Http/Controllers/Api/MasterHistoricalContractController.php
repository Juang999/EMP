<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MasterHistoricalContractController extends Controller
{
    public function index()
    {
        try {
            $data = [
                [
                    "kontrak_ke" => mt_rand(),
                    "tanggal_awal" => Carbon::now()->subDay(mt_rand(1, 365))->format('y-m-d'),
                    "tanggal_akhir" => Carbon::now()->addDay(mt_rand(1, 365))->format('y-m-d'),
                    "nomor_kontrak" => mt_rand(),
                    "keterangan" => "-"
                ],[
                    "kontrak_ke" => mt_rand(),
                    "tanggal_awal" => Carbon::now()->subDay(mt_rand(1, 365))->format('y-m-d'),
                    "tanggal_akhir" => Carbon::now()->addDay(mt_rand(1, 365))->format('y-m-d'),
                    "nomor_kontrak" => mt_rand(),
                    "keterangan" => "-"
                ],[
                    "kontrak_ke" => mt_rand(),
                    "tanggal_awal" => Carbon::now()->subDay(mt_rand(1, 365))->format('y-m-d'),
                    "tanggal_akhir" => Carbon::now()->addDay(mt_rand(1, 365))->format('y-m-d'),
                    "nomor_kontrak" => mt_rand(),
                    "keterangan" => "-"
                ],[
                    "kontrak_ke" => mt_rand(),
                    "tanggal_awal" => Carbon::now()->subDay(mt_rand(1, 365))->format('y-m-d'),
                    "tanggal_akhir" => Carbon::now()->addDay(mt_rand(1, 365))->format('y-m-d'),
                    "nomor_kontrak" => mt_rand(),
                    "keterangan" => "-"
                ],[
                    "kontrak_ke" => mt_rand(),
                    "tanggal_awal" => Carbon::now()->subDay(mt_rand(1, 365))->format('y-m-d'),
                    "tanggal_akhir" => Carbon::now()->addDay(mt_rand(1, 365))->format('y-m-d'),
                    "nomor_kontrak" => mt_rand(),
                    "keterangan" => "-"
                ]
            ];

            return response()->json([
                'status' => 'success',
                'message' => 'success to get data',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to get data',
                'error' => $th->getMessage()
            ], 400);
        }
    }
}
