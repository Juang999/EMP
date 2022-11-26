<?php

namespace Modules\Recruitment\Http\Controllers\Api\Client;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Recruitment\Entities\RekrutPengajuan;
use App\Models\DptMstr;
use App\Models\HrJabatanMaster;
use App\Models\PangkatMaster;

class SubmissionController extends Controller
{
    public function index()
    {
        try {
            $data = RekrutPengajuan::get(['pgj_code', 'pgj_pangkat','pgj_posisi', 'pgj_jabatan', 'pgj_lokasi', 'pgj_dept_id']);

            $collection = collect($data);

            $collection->each(function ($filter, $key) {
                $filter->jabatan = HrJabatanMaster::where('hrjbt_id', $filter->pgj_jabatan)->first('hrjbt_name')['hrjbt_name'];
                $filter->pangkat = PangkatMaster::where('pangkat_id', $filter->pgj_pangkat)->first('pangkat_name')['pangkat_name'];
                $filter->departement = DptMstr::where('dpt_id', $filter->pgj_dept_id)->first('dpt_desc')['dpt_desc'];
            });

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

    public function filterPangkat($pangkat_id)
    {
        try {
            $data = RekrutPengajuan::where('pgj_pangkat', $pangkat_id)->get(['pgj_code', 'pgj_pangkat','pgj_posisi', 'pgj_jabatan', 'pgj_lokasi', 'pgj_dept_id']);

            $collection = collect($data);

            $collection->each(function ($filter, $key) {
                $filter->jabatan = HrJabatanMaster::where('hrjbt_id', $filter->pgj_jabatan)->first('hrjbt_name')['hrjbt_name'];
                $filter->pangkat = PangkatMaster::where('pangkat_id', $filter->pgj_pangkat)->first('pangkat_name')['pangkat_name'];
                $filter->departement = DptMstr::where('dpt_id', $filter->pgj_dept_id)->first('dpt_desc')['dpt_desc'];
            });


            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'data' => $data,
                'total' => count($data),
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

    public function filterDept($dept_id)
    {
        try {
            $data = RekrutPengajuan::where('pgj_dept_id', $dept_id)->get(['pgj_code', 'pgj_pangkat','pgj_posisi', 'pgj_jabatan', 'pgj_lokasi', 'pgj_dept_id']);

            $collection = collect($data);

            $collection->each(function ($filter, $key) {
                $filter->jabatan = HrJabatanMaster::where('hrjbt_id', $filter->pgj_jabatan)->first('hrjbt_name')['hrjbt_name'];
                $filter->pangkat = PangkatMaster::where('pangkat_id', $filter->pgj_pangkat)->first('pangkat_name')['pangkat_name'];
                $filter->departement = DptMstr::where('dpt_id', $filter->pgj_dept_id)->first('dpt_desc')['dpt_desc'];
            });


            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'data' => $data,
                'total' => count($data),
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

    public function filterLokasi($lokasi)
    {
        try {
            $data = RekrutPengajuan::where('pgj_lokasi', 'LIKE','%'.$lokasi.'%')->get(['pgj_code', 'pgj_pangkat','pgj_posisi', 'pgj_jabatan', 'pgj_lokasi', 'pgj_dept_id']);

            $collection = collect($data);

            $collection->each(function ($filter, $key) {
                $filter->jabatan = HrJabatanMaster::where('hrjbt_id', $filter->pgj_jabatan)->first('hrjbt_name')['hrjbt_name'];
                $filter->pangkat = PangkatMaster::where('pangkat_id', $filter->pgj_pangkat)->first('pangkat_name')['pangkat_name'];
                $filter->departement = DptMstr::where('dpt_id', $filter->pgj_dept_id)->first('dpt_desc')['dpt_desc'];
            });


            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'data' => $data,
                'total' => count($data),
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

    public function search($query)
    {
        try {
            // if (DptMstr::where('dpt_desc', 'LIKE', '%'.$query.'%')->first() != NULL) {
            //     $pgj_dept_id = DptMstr::where('dpt_desc', 'LIKE', '%'.$query.'%')->first();
            // }
            $pgj_dept_id = (DptMstr::where('dpt_desc', 'LIKE', '%'.$query.'%')->first() != NULL)
            ? DptMstr::where('dpt_desc', 'LIKE', '%'.$query.'%')->first('dpt_id')['dpt_id']
            : NULL;

            $pgj_pangkat = ($pgj_dept_id == NULL && PangkatMaster::where('pangkat_name', 'LIKE', '%'.$query.'%')->first() != NULL)
            ? PangkatMaster::where('pangkat_name', 'LIKE', '%'.$query.'%')->first(['pangkat_id'])['pangkat_id']
            : NULL;


            $data = RekrutPengajuan::where('pgj_pangkat', $pgj_pangkat)
                ->orWhere('pgj_dept_id', $pgj_dept_id)
                ->orWhere('pgj_posisi', 'LIKE', '%'.$query.'%')
                ->orWhere('pgj_lokasi', 'LIKE', '%'.$query.'%')
                ->get(['pgj_code', 'pgj_pangkat','pgj_posisi', 'pgj_jabatan', 'pgj_lokasi', 'pgj_dept_id']);

            $collection = collect($data);

            $collection->each(function ($filter, $key) {
                $filter->jabatan = HrJabatanMaster::where('hrjbt_id', $filter->pgj_jabatan)->first('hrjbt_name')['hrjbt_name'];
                $filter->pangkat = PangkatMaster::where('pangkat_id', $filter->pgj_pangkat)->first('pangkat_name')['pangkat_name'];
                $filter->departement = DptMstr::where('dpt_id', $filter->pgj_dept_id)->first('dpt_desc')['dpt_desc'];
            });

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
}
