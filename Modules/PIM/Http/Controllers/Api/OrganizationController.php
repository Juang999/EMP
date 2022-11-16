<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PIM\Entities\HROrganisasi;

class OrganizationController extends Controller
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
        $sequence = HROrganisasi::where('hrorg_emp_id', $request->emp_id)->count();

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

        try {
            $organization = HROrganisasi::create([
                'hrorg_oid' => Str::uuid(),
                'hrorg_emp_id' => $request->emp_id,
                'hrorg_seq' => $sequence,
                'hrorg_organisasi' => $request->organisasiOrganisasi,
                'hrorg_jabatan' => $request->jabatanOrganisasi,
                'hrorg_status' => $request->statusOrganisasi,
                'hrorg_jns_organisasi' => $request->jenisOrganisasi,
                'hrorg_masa_jabatan' => $request->masaJabatanOrganisasi,
                'hrorg_start' => $request->tglAwalOrganisasi,
                'hrorg_end' => $request->tglAkhirOrganisasi
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat data organisasi',
                'organization' => $organization,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal membuat data organisasi',
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
            $data = HROrganisasi::where('hrorg_emp_id', $emp_id)->orderBy('hrorg_seq', 'ASC')->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data organisasi',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data organisasi',
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
    public function update(Request $request, $hrorg_oid)
    {
        try {
            $employee = HROrganisasi::where('hrorg_oid', $hrorg_oid)->first();

            HROrganisasi::where('hrorg_oid', $hrorg_oid)->update([
                'hrorg_organisasi' => ($request->organisasiOrganisasi) ? $request->organisasiOrganisasi : $employee->hrorg_organisasi,
                'hrorg_jabatan' => ($request->jabatanOrganisasi) ? $request->jabatanOrgasisai : $employee->hrorg_jabatan,
                'hrorg_status' => ($request->statusOrganisasi) ? $request->statusOrgasisai : $employee->hrorg_status,
                'hrorg_jns_organisasi' => ($request->jenisOrganisasi) ? $request->jenisOrganisasi : $employee->hrorg_jns_organisasi,
                'hrorg_masa_jabatan' => ($request->masaJabatanOrganisasi) ? $request->masaJabatanOrganisasi : $employee->hrorg_masa_jabatan,
                'hrorg_start' => ($request->tglAwalOrganisasi) ? $request->tglAwalOrganisasi : $employee->hrorg_start,
                'hrorg_end' => ($request->tglAkhirOrganisasi) ? $request->tglAkhirOrganisasi : $employee->hrorg_end
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
