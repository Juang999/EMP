<?php

namespace Modules\Recruitment\Http\Controllers\Api\Client;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Recruitment\Entities\RekrutPengajuan;
use App\Models\DptMstr;
use App\Models\HrJabatanMaster;
use App\Models\PangkatMaster;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function index()
    {
        try {
            $data = DB::table('hris.rekrut_pengajuan')
            ->selectRaw('hris.rekrut_pengajuan.pgj_code,
                                    hris.rekrut_pengajuan.pgj_pangkat_id,
                                    hris.rekrut_pengajuan.pgj_posisi,
                                    hris.rekrut_pengajuan.pgj_dept_id,
                                    hris.rekrut_pengajuan.pgj_lokasi,
                                    public.orgdpt_mstr.dpt_desc AS departement,
                                    hris.pangkat_mstr.pangkat_name AS pangkat')
            ->leftJoin('public.orgdpt_mstr', 'public.orgdpt_mstr.dpt_id', '=', 'hris.rekrut_pengajuan.pgj_dept_id')
            ->leftJoin('hris.pangkat_mstr', 'hris.pangkat_mstr.pangkat_id', '=', 'hris.rekrut_pengajuan.pgj_pangkat_id')
            ->when(request()->rank == true, function ($query) {
                $arrRank = json_decode(request()->rank);

                $query->whereIn('pgj_pangkat_id', function ($query) use ($arrRank) {
                    $query->select('pangkat_id')
                    ->from('hris.pangkat_mstr')
                    ->whereIn('pangkat_name', $arrRank)
                    ->get();
                })->get();
            })->when(request()->departement == true, function ($query) {
                $arrDept = json_decode(request()->departement);

                $query->whereIn('pgj_dept_id', function ($query) use ($arrDept) {
                    $query->select('dpt_id')
                        ->from('public.orgdpt_mstr')
                        ->whereIn('dpt_desc', $arrDept)
                        ->get();
                })->get();
            })->when(request()->location == true, function ($query) {
                $arrLoc = json_decode(request()->location);

                $query->whereIn('pgj_lokasi', $arrLoc)->get();
            })->get();

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
