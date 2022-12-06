<?php

namespace Modules\PIM\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\PIM\Entities\OrgSecMstr;
use Modules\PIM\Http\Requests\SectionRequest;
use App\Http\Controllers\Traits\Tools;

class SectionController extends Controller
{
    use Tools;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            if (request()->sect_dpt_id != NULL) {
                $data = OrgSecMstr::where([
                    ['sect_spt_id', '=', request()->sect_dpt_id],
                    ['sect_dir_id', '=', NULL]
                    ])->get();
                } elseif (request()->sect_dpt_id == NULL && request()->special != NULL) {
                    $data = OrgSecMstr::where([
                        ['sect_dir_id', '>=', 1],
                        ['sect_div_id', '=', NULL],
                        ['sect_dpt_id', '=', NULL]
                    ])->get();
                } else {
                    $data = OrgSecMstr::get();
                }

                return $this->response('berhasil', 'berhasil mengambil data', $data, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal mengambil data', $th->getMessage(), 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(SectionRequest $request)
    {
        try {
            $sect_id = (OrgSecMstr::orderBy('sect_id', 'DESC')->first('sect_id') == NULL) ? 1 : OrgSecMstr::orderBy('sect_id', 'DESC')->first('sect_id')['sect_id'] + 1;

            $data = OrgSecMstr::create([
                'sect_oid' => Str::uuid(),
                'sect_dom_id' => $request->sect_dom_id,
                'sect_en_id' => $request->sect_en_id,
                'sect_add_by' => Auth::user()->usernama,
                'sect_add_date' => Carbon::now(),
                'sect_id' => $sect_id,
                'sect_code' => $request->sect_code,
                'sect_desc' => $request->sect_desc,
                'sect_lbr_cap' => 0,
                'sect_active' => 'Y',
                'sect_dt' => Carbon::now(),
                'sect_div_id' => ($request->sect_div_id) ? $request->sect_div_id : NULL,
                'sect_dir_id' => ($request->sect_dir_id) ? $request->sect_dir_id : NULL,
                'sect_dpt_id' => ($request->sect_dpt_id) ? $request->sect_dpt_id : NULL
            ]);

            return $this->response('berhasil', 'berhasil membuat data section', $data, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal membuat data section', $th->getMessage(), 400);
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
    public function update(Request $request, OrgSecMstr $sectOid)
    {
        try {
            $sectOid->update([
                'sect_dom_id' => ($request->sect_dom_id) ? $request->sect_dom_id : $sectOid->sect_dom_id,
                'sect_en_id' => ($request->sect_en_id) ? $request->sect_en_id : $sectOid->sect_en_id,
                'sect_upd_by' => Auth::user()->usernama,
                'sect_upd_date' => Carbon::now(),
                'sect_code' => ($request->sect_code) ? $request->sect_code : $sectOid->sect_code,
                'sect_desc' => ($request->sect_desc) ? $request->sect_desc : $sectOid->sect_desc,
                'sect_lbr_cap' => ($request->sect_lbr_cap) ? $request->sect_lbr_cap : $sectOid->sect_lbr_cap,
                'sect_active' => ($request->sect_active) ? $request->sect_active : $sectOid->sect_active,
                'sect_dir_id' => ($request->sect_dir_id) ? $request->sect_dir_id : $sectOid->sect_dir_id,
                'sect_div_id' => ($request->sect_div_id) ? $request->sect_div_id : $sectOid->sect_div_id,
                'sect_dpt_id' => ($request->sect_dpt_id) ? $request->sect_dpt_id : $sectOid->sect_dpt_id
            ]);

            return $this->response('berhaisl', 'berhasil update data supervisor', true, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal update data supervisor', $th->getMessage(), 400);
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
