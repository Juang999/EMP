<?php

namespace Modules\PIM\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\PIM\Entities\HRHobbies;

class HobbiesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
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

            // $hobbies = json_decode($request->codeIdHobbies, true);

            foreach ($request->codeIdHobbies as $hobby) {
                HRHobbies::create([
                    'hr_hobbies_oid' => Str::uuid(),
                    'hr_hobbies_emp_id' => $request->emp_id,
                    'hr_hobbies_code_id' => $hobby['value'],
                    'hr_hobbies_datecreate' => Carbon::now()->format('Y-m-d')
                ]);
            }

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat data',
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

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
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

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, HRHobbies $hrHobbies)
    {
        try {

            $hrHobbies->update([
                'hr_hobbies_code_id' => ($request->codeIdHobbies) ? $request->codeIdHobbies : $hrHobbies->hr_hobbies_code_id
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil update data',
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal update data',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
