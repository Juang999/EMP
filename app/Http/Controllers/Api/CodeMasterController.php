<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CodeMaster;
use App\Models\EmpMaster;
use App\Models\EnMaster;
use App\Models\HRGolMaster;
use App\Models\HRHubKel;
use App\Models\HrJabatanMaster;
use App\Models\HRJenisBisnis;
use App\Models\HrJenisKeahlian;
use App\Models\HRKotaUmk;
use App\Models\HRPendidikan;
use App\Models\HRPendidikanMaster;
use App\Models\HRPeriodeMaster;
use App\Models\HrStatusMaster;
use App\Models\HrWorkGroup;
use App\Models\MntMaster;
use App\Models\PangkatMaster;
use App\Models\PosMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CodeMasterController extends Controller
{
    public function getGolDarah()
    {
        try {
            $golDarah = CodeMaster::where('code_field', 'gol_darah')->get(['code_id', 'code_name']);

            return response()->json([
                'code' => 200,
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data golongan darah',
                'golongan_darah' => $golDarah,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
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
                'code' => 200,
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data gender',
                'gender' => $gender
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
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
                'code' => 200,
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data area',
                'area' => $area_id
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data area',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function getHrStatusId()
    {
        try {
            $statusId = CodeMaster::where('code_field', 'emp_hrstatus_id')->get(['code_id', 'code_name']);

            return response()->json([
                'code' => 200,
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data id status',
                'status_id' => $statusId
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
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
                'code' => 200,
                'keahlian' => $keahlian
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
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
                'code' => 200,
                'workGroup' => $workGroup
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function getPosMaster()
    {
        try {
            $posisi = PosMaster::get();

            return response()->json([
                'code' => 200,
                'posisi' => $posisi
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function getStatus()
    {
        try {
            $status = HrStatusMaster::get();

            return response()->json([
                'code' => 200,
                'status' => $status
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function getHirarki()
    {
        try {
            $hirarki = EmpMaster::get(['emp_fname', 'emp_mname', 'emp_lname', 'emp_id']);

            return response()->json([
                'code' => 200,
                'hirarki' => $hirarki
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data hirarki',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function getPendidikan()
    {
        try {
            $pendidikan = HRPendidikanMaster::get();

            return response()->json([
                'code' => 200,
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'pendidikan' => $pendidikan
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data pendidikan',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function getAllKaryawan()
    {
        try {
            $karyawan = DB::table('public.emp_mstr')
            ->select(DB::raw("CONCAT(emp_fname, ' ', emp_lname) AS label, emp_id AS value"))
            ->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil nama karyawan',
                'data' => $karyawan,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data nama karyawan',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    public function getJabatan()
    {
        try {
            $jabatan = HrJabatanMaster::get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data jabatan',
                'jabatan' => $jabatan,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data jabatan',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    public function getStatusMarital()
    {
        try {
            $statusMarital = CodeMaster::where('code_field', 'emp_status_marital')->get(['code_id', 'code_code', 'code_name']);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data status marital',
                'statusMarital' => $statusMarital,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data status marital',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    public function getPeriode()
    {
        try {
            $data = HRPeriodeMaster::get();

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

    public function getMonth()
    {
        try {
            $month = DB::table('hris.mnt_mstr')->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data bulan',
                'month' => $month,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data bulan',
                'galat' => $month,
                'code' => 400
            ], 400);
        }
    }

    public function getPangkat()
    {
        try {
            $data = PangkatMaster::get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data pangkat',
                'data' => $data,
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

    public function getHrGol()
    {
        try {
            $data = HRGolMaster::get();

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

    public function getHrKotaUmk()
    {
        try {
            $data = HRKotaUmk::get();

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

    public function getHubKel()
    {
        try {
            $data = HRHubKel::get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil pesan',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    public function getEntity()
    {
        try {
            $entitas = EnMaster::get();

            return response()->json([
                'code' => 200,
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data entitas',
                'entitas' => $entitas
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data entitas',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    public function getStatusPerusahaan()
    {
        try {
            $data = HRJenisBisnis::get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data tipe perusahaan',
                'tipe_perusahaan' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data tipe perusahaan',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    public function getTipeSakit()
    {
        try {
            $data = CodeMaster::where('code_field', 'tipe_sakit')->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengabil data tipe sakit',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data tipe sakit',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    public function getStatusId()
    {
        try {
            $data = CodeMaster::where('code_filed', 'emp_hrstatus_id')->get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil status',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data status',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }
}
