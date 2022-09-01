<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JobHistoryController extends Controller
{
    public function index()
    {
        try {
            $data = [
                [
                    "___id" => mt_rand(),
                    "posisi" => "Human Resource",
                    "tglAwal" => Carbon::now()->subDay(730)->format('y-m-d'),
                    "tglAkhir" => Carbon::now()->subDay(365)->format('y-m-d'),
                    "ket" => "-"
                ]
            ];

            return response()->json([
                'status' => 'success',
                'message' => 'success to get data',
                'data' => $data,
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
