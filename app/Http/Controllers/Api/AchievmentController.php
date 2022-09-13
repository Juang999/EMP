<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AchievmentController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $achievment = HRPrestasi::create([
                'hrpres_oid' => Str::uuid(),
                
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
