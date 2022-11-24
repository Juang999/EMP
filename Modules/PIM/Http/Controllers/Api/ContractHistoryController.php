<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PIM\Entities\HRKontrak;

class ContractHistoryController extends Controller
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
        $sequence = HRKontrak::where('hrkontrak_emp_id', $request->emp_id)->count();

        if (!$sequence) {
            $sequence = 1;
        } elseif ($sequence == 5) {
            return response()->json([
                'status' => 'redirected',
                'pesan' => 'input telah mencapai batas limit',
                'limit' => 5,
                'code' => 300
            ], 300);
        } else {
            $sequence++;
        }

        try {
            $historicalContract = HRKontrak::create([
                'hrkontrak_oid' => Str::uuid(),
                'hrkontrak_emp_id' => $request->emp_id,
                'hrkontrak_seq' => $sequence,
                'hrkontrak_start' => $request->tglAwalKontrak,
                'hrkontrak_end' => $request->tglAkhirKontrak,
                'hrkontrak_remarks' => $request->remarksKontrak,
                'hrkontrak_number' => $request->kontrakKeKontrak,
                'hrkontrak_name' => $request->tipeKontrak
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat data',
                'data' => $historicalContract,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal membuat pesan',
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
            $data = HRKontrak::where('hrkontrak_emp_id', $emp_id)->orderBy('hrkontrak_seq')->get();

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
    public function update(Request $request, HRKontrak $hrKontrak)
    {
        try {
            $hrKontrak->update([
                'hrkontrak_start' => ($request->tglAwalKontrak) ? $request->tglAwalKontrak : $hrKontrak->hrkontrak_start,
                'hrkontrak_end' => ($request->tglAkhirKontrak) ? $request->tglAkhirKontrak : $hrKontrak->hrkontrak_end,
                'hrkontrak_remarks' => ($request->remarksKontrak) ? $request->remarksKontrak : $hrKontrak->hrkontrak_remarks,
                'hrkontrak_number' => ($request->kontrakKeKontrak) ? $request->kontrakKeKontrak : $hrKontrak->hrkontrak_number,
                'hrkontrak_name' => ($request->tipeKontrak) ? $request->tipeKontrak : $hrKontrak->hrkontrak_name
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
