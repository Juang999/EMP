<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CodeMaster;
use App\Models\HrJenisKeahlian;
use App\Models\HrWorkGroup;
use Illuminate\Http\Request;

class CodeMasterController extends Controller
{
    public function getGolDarah()
    {
        try {
            $golDarah = CodeMaster::where('code_field', 'gol_darah')->get(['code_id', 'code_name']);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data golongan darah',
                'golongan_darah' => $golDarah
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data golongan darah',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function getGender()
    {
        try {
            $gender = CodeMaster::where('code_field', 'Jenis_Kelamin')->get(['code_id', 'code_name']);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data gender',
                'gender' => $gender
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data gender',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function getAreaId()
    {
        try {
            $area_id = codeMaster::where('code_field', 'area_id')->get(['code_id', 'code_name']);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data area',
                'area' => $area_id
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data area',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function getStatusId()
    {
        try {
            $statusId = CodeMaster::where('code_field', 'emp_hrstatus_id')->get(['code_id', 'code_name']);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data id status',
                'status_id' => $statusId
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data id status',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function getKeahlian()
    {
        try {
            $keahlian = HrJenisKeahlian::get();

            return response()->json([
                'keahlian' => $keahlian
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data jenis keahlian',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function getWorkGroup()
    {
        try {
            $workGroup = HrWorkGroup::get();

            return response()->json([
                'workGroup' => $workGroup
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data',
                'galat' => $th->getMessage()
            ], 400);
        }
    }
}
