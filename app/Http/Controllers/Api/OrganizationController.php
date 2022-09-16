<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HROrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    public function index($emp_id)
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
                'hrorg_organisasi' => $request->organisasi,
                'hrorg_jabatan' => $request->jabatan,
                'hrorg_status' => $request->status,
                'hrorg_jns_organisasi' => $request->jnsOrganisasi,
                'hrorg_masa_jabatan' => $request->masaJabatan,
                'hrorg_start' => $request->startOrg,
                'hrorg_end' => $request->endOrg
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
}
