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
                    "___id" => mt_rand(),
                    "kontrakKe" => mt_rand(),
                    "tglAwal" => Carbon::now()->subDay(mt_rand(1, 365))->format('y-m-d'),
                    "tglAkhir" => Carbon::now()->addDay(mt_rand(1, 365))->format('y-m-d'),
                    "noKontrak" => mt_rand(),
                    "ket" => "-"
                ],[
                    "___id" => mt_rand(),
                    "kontrakKe" => mt_rand(),
                    "tglAwal" => Carbon::now()->subDay(mt_rand(1, 365))->format('y-m-d'),
                    "tglAkhir" => Carbon::now()->addDay(mt_rand(1, 365))->format('y-m-d'),
                    "noKontrak" => mt_rand(),
                    "ket" => "-"
                ],[
                    "___id" => mt_rand(),
                    "kontrakKe" => mt_rand(),
                    "tglAwal" => Carbon::now()->subDay(mt_rand(1, 365))->format('y-m-d'),
                    "tglAkhir" => Carbon::now()->addDay(mt_rand(1, 365))->format('y-m-d'),
                    "noKontrak" => mt_rand(),
                    "ket" => "-"
                ],[
                    "___id" => mt_rand(),
                    "kontrakKe" => mt_rand(),
                    "tglAwal" => Carbon::now()->subDay(mt_rand(1, 365))->format('y-m-d'),
                    "tglAkhir" => Carbon::now()->addDay(mt_rand(1, 365))->format('y-m-d'),
                    "noKontrak" => mt_rand(),
                    "ket" => "-"
                ],[
                    "___id" => mt_rand(),
                    "kontrakKe" => mt_rand(),
                    "tglAwal" => Carbon::now()->subDay(mt_rand(1, 365))->format('y-m-d'),
                    "tglAkhir" => Carbon::now()->addDay(mt_rand(1, 365))->format('y-m-d'),
                    "noKontrak" => mt_rand(),
                    "ket" => "-"
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
