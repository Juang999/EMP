<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\PIM\Entities\HRMasaSP;

class WarningLetterController extends Controller
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
        $total = HRMasaSP::where('hrsp_emp_id', $request->emp_id)->count();

        if ($total == 5) {
            return response()->json([
                'status' => 'redirected',
                'pesan' => 'kamu sudah mencapai limit',
                'limit' => 5,
                'code' => 300
            ], 300);
        }

        // dd($request->all());
        try {
            $data = HRMasaSP::create([
                'hrsp_oid' => Str::uuid(),
                'hrsp_emp_id' => $request->emp_id,
                'hrsp_sp' => $request->suratPeringatanSP,
                'hrsp_desc' => $request->descSP,
                'hrsp_start_periode' => $request->periodeSP,
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menginputkan data',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menginputkan data',
                'galat' => $th->getMessage(),
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
            // $data = HRMasaSP::where('hrsp_emp_id', $emp_id)->get();

            $data = DB::table('hris.hr_masa_sp')
                ->select(DB::raw('hris.hr_masa_sp.*, hris.hrperiode_mstr.*'))
                ->join('hris.hrperiode_mstr', 'hris.hr_masa_sp.hrsp_start_periode', '=', 'hris.hrperiode_mstr.hrperiode_code')
                ->where('hrsp_emp_id', '=', $emp_id)
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
    public function update(Request $request, HRMasaSP $hrMasaSP)
    {
        try {
            $hrMasaSP->update([
                'hrsp_sp' => ($request->suratPeringatanSP) ? $request->suratPeringatanSP : $hrMasaSP->hrsp_sp,
                'hrsp_desc' => ($request->descSP) ? $request->descSP : $hrMasaSP->hrsp_desc,
                'hrsp_start_periode' => ($request->periodeSP) ? $request->periodeSP : $hrMasaSP->hrsp_start_periode
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
