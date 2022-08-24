<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FamilyController extends Controller
{
    public function index()
    {
        try {
            $data = [
                [
                    "hubungan" => "istri",
                    "nama" => "emily",
                    "tanggal_lahir" => Carbon::now()->subDay(7300)->format('y-m-d'),
                    "keterangan" => '-'
                ],[
                    "hubungan" => "anak",
                    "nama" => "bily",
                    "tanggal_lahir" => Carbon::now()->subDay(mt_rand(1, 365))->format('y-m-d'),
                    "keterangan" => '-'
                ],[
                    "hubungan" => "anak",
                    "nama" => "krixy",
                    "tanggal_lahir" => Carbon::now()->subDay(mt_rand(1, 365))->format('y-m-d'),
                    "keterangan" => '-'
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
