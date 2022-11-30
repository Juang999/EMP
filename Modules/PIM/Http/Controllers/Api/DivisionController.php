<?php

namespace Modules\PIM\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Traits\Tools;
use Illuminate\Support\Facades\Auth;
use Modules\PIM\Entities\OrgDivMstr;
use Modules\PIM\Http\Requests\DivisionRequest;
use Carbon\Carbon;

class DivisionController extends Controller
{
    use Tools;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            if (request()->div_dir_id != NULL) {
                $data = OrgDivMstr::where('div_dir_id', request()->div_dir_id)->get();
            } elseif (request()->div_dir_id == NULL && request()->special != NULL) {
                $data = OrgDivMstr::where('div_dir_id', '!=', NULL)->get();
            } else {
                $data = OrgDivMstr::orderBy('div_id', 'ASC')->get();
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
    public function store(DivisionRequest $request)
    {
        try {
            $div_id = (OrgDivMstr::orderBy('div_id', 'DESC')->first() == NULL) ? 1 : OrgDivMstr::orderBy('div_id', 'DESC')->first()['div_id'] + 1;

            $data = OrgDivMstr::create([
                'div_oid' => Str::uuid(),
                'div_dom_id' => $request->div_dom_id,
                'div_en_id' => $request->div_en_id,
                'div_add_by' => Auth::user()->usernama,
                'div_add_date' => Carbon::now(),
                'div_id' => $div_id,
                'div_code' => $request->div_code,
                'div_desc' => $request->div_desc,
                'div_lbr_cap' => 0,
                'div_active' => 'Y',
                'div_dt' => Carbon::now(),
                'div_dir_id' => $request->div_dir_id
            ]);

            return $this->response('berhasil', 'berhasil membuat data divisi', $data, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal mengambil data', $th->getMessage(), 400);
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
