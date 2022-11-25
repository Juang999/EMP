<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PIM\Entities\HRKeluarga;
use Modules\PIM\Http\Requests\FamilyRequest;

class FamilyController extends Controller
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
    public function store(FamilyRequest $request)
    {
        try {
            $sequence = HRKeluarga::where('hrkel_emp_id', $request->emp_id)->count();

            if (!$sequence) {
                $sequence = 1;
            } elseif ($sequence == 5) {
                return response()->json([
                    'status' => 'redirected',
                    'pesan' => 'input sudah melebihi limit!',
                    'limit' => 5,
                    'code' => 300
                ], 300);
            } else {
                $sequence++;
            }

            $family = HRKeluarga::create([
                'hrkel_oid' => Str::uuid(),
                'hrkel_emp_id' => $request->emp_id,
                'hrkel_seq' => $sequence,
                'hrkel_hub_id' => $request->jenisHubunganHubungan,
                'hrkel_nama' => $request->namaHubungan,
                'hrkel_tgl_lahir' => $request->tglLahirHubungan,
                'hrkel_tempat_lahir' => $request->tmptLahirHubungan,
                'hrkel_remarks' => $request->keteranganHubungan
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat data keluarga',
                'data' => $family,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal membuat data keluarga',
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
            $data = HRKeluarga::where('hrkel_emp_id', $emp_id)->orderBy('hrkel_seq', 'ASC')->with('HRHubKel')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'success to get data',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to get data',
                'error' => $th->getMessage(),
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
    public function update(Request $request, $hrkel_oid)
    {
        try {
            $employee = HRKeluarga::where('hrkel_oid', $hrkel_oid)->first();

            HRKeluarga::where('hrkel_oid', $hrkel_oid)->update([
                'hrkel_hub_id' => ($request->jenisHubunganHubungan) ? $request->jenisHubunganHubungan : $employee->hrkel_hub_id,
                'hrkel_nama' => ($request->namaHubungan) ? $request->namaHubungan : $employee->hrkel_nama,
                'hrkel_tgl_lahir' => ($request->tglLahirHubungan) ? $request->tglLahirHubungan : $employee->hrkel_tgl_lahir,
                'hrkel_tempat_lahir' => ($request->tmptLahirHubungan) ? $request->tmptLahirHubungan : $employee->hrkel_tempat_lahir,
                'hrkel_remarks' => ($request->keteranganHubungan) ? $request->keteranganHubungan : $employee->hrkel_remarks
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
                'line' => $th->getLine(),
                'file' => $th->getFile(),
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
