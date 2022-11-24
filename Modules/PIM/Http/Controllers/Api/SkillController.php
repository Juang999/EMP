<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PIM\Entities\HRKeahlian;

class SkillController extends Controller
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
            $total = HRKeahlian::where('hrahli_emp_id', $request->emp_id)->count();

            if ($total == 5) {
                return response()->json([
                    'status' => 'redirected',
                    'pesan' => 'input sudah melebihi limit!',
                    'limit' => 5,
                    'code' => 300
                ], 300);
            }

            $skill = HRKeahlian::create([
                'hrahli_oid' => Str::uuid(),
                'hrahli_emp_id' => $request->emp_id,
                'hrahli_jenis_keahlian' => $request->jenisKeahlian,
                'hrahli_tingkat' => $request->tingkatKeahlian,
                'hrahli_prestasi' => $request->prestasiKeahlian
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil inputkan data',
                'skill' => $skill,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal inputkan data',
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
            $data = HRKeahlian::where('hrahli_emp_id', $emp_id)->get();

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
    public function update(Request $request, HRKeahlian $hrKeahlian)
    {
        try {
            $hrKeahlian->update([
                'hrahli_jenis_keahlian' => ($request->jenisKeahlian) ? $request->jenisKeahlian : $hrKeahlian->hrahli_jenis_keahlian,
                'hrahli_tingkat' => ($request->tingkatKeahlian) ? $request->tingkatKeahlian : $hrKeahlian->hrahli_tingkat,
                'hrahli_prestasi' => ($request->prestasiKeahlian) ? $request->prestasiKeahlian : $hrKeahlian->hrahli_prestasi
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
