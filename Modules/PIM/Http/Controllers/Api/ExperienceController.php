<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PIM\Entities\HRPengalaman;
use Illuminate\Support\Str;

class ExperienceController extends Controller
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
            $sequence = HRPengalaman::where('hrpeng_emp_id', $request->emp_id)->count();

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

            $data = HRPengalaman::create([
                'hrpeng_oid' => Str::uuid(),
                'hrpeng_emp_id' => $request->emp_id,
                'hrpeng_seq' => $sequence,
                'hrpeng_perusahaan' => $request->namaPerusahaanPengalamanKerja,
                'hrpeng_jabatan' => $request->jabatanPerusahaanPengalamanKerja,
                // 'hrpeng_status' => $request->statusPerusahaanPengalamanKerja,
                'hrpeng_start' => $request->thnAwalPerusahaanPengalamanKerja,
                'hrpeng_end' => $request->thnAkhirPerusahaanPengalamanKerja,
                'hrpeng_jns_bisnis' => $request->jenisPerusahaanPengalamanKerja,
                // 'hrpeng_jabatan_atasan' => $request->jabatanAtasanPerusahaanPengalamanKerja,
                // 'hrpeng_jml_bawahan_lgsg' => $request->jmlBawahanLgsgPerushaanPenglamanKerja,
                // 'hrpeng_jml_bawahan_total' => $request->jmlBawahanTotalPerusahaanPengalamanKerja
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil menginputkan data pengalaman',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal menginputkan data pengalaman',
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
            $data = HRPengalaman::where('hrpeng_emp_id', $emp_id)->orderBy('hrpeng_seq', 'ASC')->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data pengalman',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data pengalaman',
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
    public function update(Request $request, HRPengalaman $hrPengalaman)
    {
        try {
            $hrPengalaman->update([
                'hrpeng_perusahaan' => ($request->namaPerusahaanPengalamanKerja) ? $request->namaPerusahaanPengalamanKerja : $hrPengalaman->hrpeng_perusahaan,
                'hrpeng_jabatan' => ($request->jabatanPerusahaanPengalamanKerja) ? $request->jabatanPerusahaanPengalamanKerja : $hrPengalaman->hrpeng_jabatan,
                'hrpeng_start' => ($request->thnAwalPerusahaanPengalamanKerja) ? $request->thnAwalPerusahaanPengalamanKerja : $hrPengalaman->hrpeng_start,
                'hrpeng_end' => ($request->thnAkhirPerusahaanPengalamanKerja) ? $request->thnAkhirPerusahaanPengalamanKerja : $hrPengalaman->hrpeng_end,
                'hrpeng_jns_bisnis' => ($request->jenisPerusahaanPengalamanKerja) ? $request->jenisPerusahaanPengalamanKerja : $hrPengalaman->hrpeng_jns_bisnis,
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
