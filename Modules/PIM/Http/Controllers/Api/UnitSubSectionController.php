<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Traits\Tools;
use Modules\PIM\Entities\OrgUSectMstr;
use Modules\PIM\Http\Requests\UnitSubSectionRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UnitSubSectionController extends Controller
{
    use Tools;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            if (request()->usect_ssect_id != NULL) {
                $data = OrgUSectMstr::where('usect_ssect_id', request()->usect_ssect_id)->get();
            } elseif (request()->usect_ssect_id == NULL && request()->special == true) {
                $data = OrgUSectMstr::where('usect_dir_id', '!=', NULL)->get();
            } else {
                $data = OrgUSectMstr::get();
            }

            return $this->response('berhasil', 'berhasil mengambil data unit-sub-section', $data, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal mengambil data unit-sub-section', $th->getMessage(), 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(UnitSubSectionRequest $request)
    {
        try {
            $usect_id = (OrgUSectMstr::orderBy('usect_id', 'DESC')->first() == NULL) ? 1 : OrgUSectMstr::orderBy('usect_id', 'DESC')->first('usect_id')['usect_id'] + 1;

            $data = OrgUSectMstr::create([
                'usect_oid' => Str::uuid(),
                'usect_dom_id' => $request->usect_dom_id,
                'usect_en_id' => $request->usect_en_id,
                'usect_add_by' => Auth::user()->usernama,
                'usect_add_date' => Carbon::now(),
                'usect_id' => $usect_id,
                'usect_code' => $request->usect_code,
                'usect_desc' => $request->usect_desc,
                'usect_lbr_cap' => 0,
                'usect_active' => 'Y',
                'usect_dt' => Carbon::now(),
                'usect_ssect_id' => ($request->usect_ssect_id) ? $request->usect_ssect_id : NULL,
                'usect_sect_id' => ($request->usect_sect_id) ? $request->usect_sect_id : NULL,
                'usect_dpt_id' => ($request->usect_dpt_id) ? $request->usect_dpt_id : NULL,
                'usect_div_id' => ($request->usect_div_id) ? $request->usect_div_id : NULL,
                'usect_dir_id' => ($request->usect_dir_id) ? $request->usect_dir_id : NULL
            ]);

            return $this->response('berhasil', 'berhasil membuat data unit', $data, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal membuat data unit', $th->getMessage(), 400);
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
    public function update(Request $request, $id)
    {
        //
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
