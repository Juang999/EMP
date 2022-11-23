<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PIM\Entities\HRPosisi;

class PositionController extends Controller
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
        $sequence = HRPosisi::where('hrpos_emp_id', $request->emp_id)->count();

        if (!$sequence) {
            $sequence = 1;
        } elseif ($sequence == 5) {
            return response()->json([
                'status' => 'redirected',
                'pesan' => 'kamu telah mencapai limit',
                'limit' => 5,
                'code' => 300
            ], 300);
        } else {
            $sequence++;
        }

        try {
            $data = HRPosisi::create([
                'hrpos_oid' => Str::uuid(),
                'hrpos_emp_id' => $request->emp_id,
                'hrpos_seq' => $sequence,
                'hrpos_posisi' => $request->posisiPosisi,
                'hrpos_start' => $request->tglAwalPosisi,
                'hrpos_end' => $request->tglAkhirPosisi,
                'hrpos_remarks' => $request->keteranganPosisi
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
            $data = HRPosisi::where('hrpos_emp_id', $emp_id)->orderBy('hrpos_seq')->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil memanggil data',
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
    public function update(Request $request, HRPosisi $hrPosisi)
    {
        try {
            $hrPosisi->update([
                'hrpos_posisi' => ($request->posisiPosisi) ? $request->posisiPosisi : $hrPosisi->hrpos_posisi,
                'hrpos_start' => ($request->tglAwalPosisi) ? $request->tglAwalPosisi : $hrPosisi->hrpos_start,
                'hrpos_end' => ($request->tglAkhirPosisi) ? $request->tglAkhirPosisi : $hrPosisi->hrpos_end,
                'hrpos_remarks' => ($request->keteranganPosisi) ? $request->keteranganPosisi : $hrPosisi->hrpos_remarks
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil udpate data',
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
