<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PIM\Entities\PangkatMaster;
use Modules\PIM\Entities\EmpMaster;

class RankController extends Controller
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
            EmpMaster::where('emp_id', $request->emp_id)->update([
                'emp_pangkat_id' => $request->pangkatId
            ]);

            $pangkat = EmpMaster::where('emp_id', $request->emp_id)->with('PangkatMaster')->first('emp_pangkat_id');

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menambahkan pangkat',
                'pangkat' => $pangkat,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menambahkan pangkat',
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
            $pangkat = EmpMaster::where('emp_id', $emp_id)->with('PangkatMaster')->first(['emp_id', 'emp_pangkat_id']);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data pangkat',
                'pangkat' => $pangkat,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data pangkat',
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
    public function update(Request $request, $id)
    {
        //
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
