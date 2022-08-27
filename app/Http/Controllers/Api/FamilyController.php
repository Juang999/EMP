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
                    "___id" => mt_rand(),
                    "hub" => "istri",
                    "nama" => "emily",
                    "tglLahir" => Carbon::now()->subDay(7300)->format('y-m-d'),
                    "ket" => '-'
                ],[
                    "___id" => mt_rand(),
                    "hub" => "anak",
                    "nama" => "joyboy",
                    "tglLahir" => Carbon::now()->subDay(7300)->format('y-m-d'),
                    "ket" => '-'
                ],[
                    "___id" => mt_rand(),
                    "hub" => "anak",
                    "nama" => "krixi",
                    "tglLahir" => Carbon::now()->subDay(7300)->format('y-m-d'),
                    "ket" => '-'
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
