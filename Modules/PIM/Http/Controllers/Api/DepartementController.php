<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\PIM\Entities\OrgDptMstr;
use Modules\PIM\Http\Requests\DepartementRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Controllers\Traits\Tools;

class DepartementController extends Controller
{
    use Tools;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            if (request()->dpt_div_id != NULL) {
                $data = OrgDptMstr::where([
                    ['dpt_div_id', '=', request()->dpt_div_id],
                    ['dpt_dir_id', '=', NULL]
                ])->get();
            } elseif (request()->dpt_div_id == NULL && request()->special == true) {
                $data = OrgDptMstr::where('dpt_dir_id', '!=', NULL)->get();
            } else {
                $data = OrgDptMstr::get();
            }

            return $this->response('berhasil', 'berhasil mengambil data', $data, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal membuat data', $th->getMessage(), 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(DepartementRequest $request)
    {
        try {
            $dpt_id = (OrgDptMstr::orderBy('dpt_id', 'DESC')->first() == NULL) ? 1 : OrgDptMstr::orderBy('dpt_id', 'DESC')->first('dpt_id')['dpt_id'] + 1;


            $data = OrgDptMstr::create([
                'dpt_oid' => Str::uuid(),
                'dpt_dom_id' => $request->dpt_dom_id,
                'dpt_en_id' => $request->dpt_en_id,
                'dpt_add_by' => Auth::user()->usernama,
                'dpt_add_date' => Carbon::now(),
                'dpt_id' => $dpt_id,
                'dpt_code' => $request->dpt_code,
                'dpt_desc' => $request->dpt_desc,
                'dpt_lbr_cap' => 0,
                'dpt_active' => 'Y',
                'dpt_dt' => Carbon::now(),
                'dpt_div_id' => ($request->dpt_div_id != NULL) ? $request->dpt_div_id : NULL,
                'dpt_dir_id' => ($request->dpt_dir_id != NULL) ? $request->dpt_dir_id : NULL
            ]);

            return $this->response('berhasil', 'berhasil membuuat data departemen', $data, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal membuat data departemen', $th->getMessage(), 400);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, OrgDptMstr $dptOid)
    {
        try {
            $dptOid->update([
                'dpt_dom_id' => ($request->dpt_dom_id) ? $request->dpt_dom_id : $dptOid->dpt_dom_id,
                'dpt_en_id' => ($request->dpt_en_id) ? $request->dpt_en_id : $dptOid->dpt_en_id,
                'dpt_upd_by' => Auth::user()->usernama,
                'dpt_upd_date' => Carbon::now(),
                'dpt_code' => ($request->dpt_code) ? $request->dpt_code : $dptOid->dpt_code,
                'dpt_desc' => ($request->dpt_desc) ? $request->dpt_desc : $dptOid->dpt_desc,
                'dpt_lbr_cap' => ($request->dpt_lbr_cap) ? $request->dpt_lbr_cap : $dptOid->dpt_lbr_cap,
                'dpt_active' => ($request->dpt_active) ? $request->dpt_active : $dptOid->dpt_active,
                'dpt_dir_id' => ($request->dpt_dir_id) ? $request->dpt_dir_id : $dptOid->dpt_dir_id,
                'dpt_div_id' => ($request->dpt_div_id) ? $request->dpt_div_id : $dptOid->dpt_div_id
            ]);

            return $this->response('berhasil', 'berhasil update data departemen', true, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal update data departemen', $th->getMessage(), 400);
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

    public function deleteDivision(OrgDptMstr $dptOid)
    {
        try {
            $dptOid->update([
                'dpt_div_id' => NULL
            ]);

            return $this->response('berhasil', 'berhasil menghapus hirarki ke divisi', true, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal menghapus hirarki ke divisi', $th->getMessage(), 400);
        }
    }
}
