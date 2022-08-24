<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EducationController extends Controller
{
    public function index()
    {
        // dd(Carbon::createFromFormat('Y-m-d', '2016-01-23'));

        try {
            $data = [
                [
                    "jenjang" => "SMA",
                    "lembaga" => "Yayasan Fajrussalam Bina Umat",
                    "jurusan" => "Agama",
                    "tahun awal" => Carbon::createFromFormat('Y-m-d', '2020-08-12'),
                    "tahun akhir" => Carbon::createFromFormat('Y-m-d', '2021-08-12')
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
