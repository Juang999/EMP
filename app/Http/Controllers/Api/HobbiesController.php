<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRHobbies;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HobbiesController extends Controller
{
    public function show($emp_id)
    {
        try {
            $data = DB::table('hris.hr_hobbies')
            ->select(DB::raw('hris.hr_hobbies.hr_hobbies_oid, hris.hr_hobbies.hr_hobbies_datecreate, public.code_mstr.code_name'))
            ->leftJoin('public.code_mstr', 'hris.hr_hobbies.hr_hobbies_code_id', '=', 'public.code_mstr.code_id')
            ->where('hr_hobbies_emp_id', '=', $emp_id)
            ->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data',
                'galat' => $th->getMessage(),
                'line' => $th->getLine(),
                'code' => 400
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $count = HRHobbies::where('hr_hobbies_emp_id', $request->emp_id)->count();

            if ($count == 5) {
                return response()->json([
                    'status' => 'gagal',
                    'pesan' => 'input telah mencapai limit',
                    'limit' => 5,
                    'code' => 300
                ], 300);
            }
            $hobbies = json_decode($request->codeIdHobbies, true);
            foreach ($hobbies as $hobby) {
                $data = HRHobbies::create([
                        'hr_hobbies_oid' => Str::uuid(),
                    'hr_hobbies_emp_id' => $request->emp_id,
                    'hr_hobbies_code_id' => $hobby['codeIdHobbies'],
                    'hr_hobbies_datecreate' => Carbon::now()->format('Y-m-d')
                ]);
            }

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat data',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal membuat data',
                'galat' => $th->getMessage(),
                'line' => $th->getLine(),
                'code' => 400
            ], 400);
        }
    }
}
