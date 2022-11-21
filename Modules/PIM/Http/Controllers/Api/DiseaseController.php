<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PIM\Entities\HRSakit;
use App\Http\Controllers\Traits\Tools;
use Illuminate\Support\Str;

class DiseaseController extends Controller
{
    use Tools;

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
            $sequence = HRSakit::where('hrsakit_emp_id', $request->emp_id)->count();

            if (!$sequence) {
                $sequence = 1;
            } elseif ($sequence = 5) {
                return response()->json([
                    'status' => 'gagal',
                    'pesan' => 'input sudah mencapai limit',
                    'limit' => 5,
                    'code' => 300
                ], 300);
            }

            $data = HRSakit::create([
                'hrsakit_oid' => Str::uuid(),
                'hrsakit_emp_id' => $request->emp_id,
                'hrsakit_jenis' => $request->jenisSakit,
                'hrsakit_lama' => $request->lamaSakit,
                'hrsakit_tahun' => $request->tahunSakit,
                'hrsakit_kondisi' => $request->kondisiSaatIniSakit,
                'hrsakit_seq' => $sequence
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menambahkan data sakit & cacat',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menambahkan data sakit & cacat',
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
            $data = HRSakit::where('hrsakit_emp_id', $emp_id)->get();

            return $this->response('berhasil', 'berhasil megnambil data', $data, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal mengabil data', $th->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, HRSakit $hrSakit)
    {
        try {
            $hrSakit->update([
                'hrsakit_jenis' => ($request->jenisSakit) ? $request->jenisSakit : $hrSakit->hrsakit_jenis,
                'hrsakit_lama' => ($request->lamaSakit) ? $request->lamaSakit : $hrSakit->hrsakit_lama,
                'hrsakit_tahun' => ($request->tahunSakit) ? $request->$request->tahunSakit : $hrSakit->hrsakit_tahun,
                'hrsakit_kondisi' => ($request->kondisiSaatIniSakit) ? $request->kondisiSaatIniSakit : $hrSakit->hrsakit_kondisi,
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
                'path' => $th->getFile(),
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
