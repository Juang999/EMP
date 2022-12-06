<?php

namespace Modules\PIM\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Traits\Tools;
use Illuminate\Http\{Request, Response};
use Modules\PIM\Entities\OrgSubSectMstr;
use Illuminate\Support\{Str, Facades\Auth};
use Modules\PIM\Entities\OrgSecMstr;
use Modules\PIM\Http\Requests\SubSectionRequest;

class SubSectionController extends Controller
{
    use Tools;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            if (request()->ssect_sect_id != NULl) {
                $data = OrgSubSectMstr::where([
                    ['ssect_sect_id', '=', request()->ssect_sect_id],
                    ['ssect_dir_id', '=', NULL]
                    ])->get();
            } elseif (request()->ssect_sect_id == NULL &&request()->special == true) {
                $data = OrgSubSectMstr::where([
                    ['ssect_dir_id', '!=', NULL],
                    ['ssect_sect_id', '=', NULL],
                    ['ssect_sect_id', '=', NULL],
                    ['ssect_sect_id', '=', NULL],
                ])->get();
            } else {
                $data = OrgSubSectMstr::get();
            }

            return $this->response('berhasil', 'berhasil mengambil data sub-section', $data, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal mengambil data sub-section', $th->getMessage(), 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(SubSectionRequest $request)
    {
        try {
            $ssect_id = (OrgSubSectMstr::orderBy('ssect_id', 'DESC')->first('ssect_id') == NULL) ? 1 : OrgSubSectMstr::orderBy('ssect_id', 'DESC')->first('ssect_id')['ssect_id'] + 1;

            $data = OrgSubSectMstr::create([
                'ssect_oid' => Str::uuid(),
                'ssect_dom_id' => $request->ssect_dom_id,
                'ssect_en_id' => $request->ssect_en_id,
                'ssect_add_by' => Auth::user()->usernama,
                'ssect_add_date' => Carbon::now(),
                'ssect_id' => $ssect_id,
                'ssect_code' => $request->ssect_code,
                'ssect_desc' => $request->ssect_desc,
                'ssect_lbr_cap' => 0,
                'ssect_active' => 'Y',
                'ssect_dt' => Carbon::now(),
                'ssect_sect_id' => ($request->ssect_sect_id != NULL) ? $request->ssect_sect_id : NULL,
                'ssect_dept_id' => ($request->ssect_dept_id != NULL) ? $request->ssect_dept_id : NULL,
                'ssect_div_id' => ($request->ssect_div_id != NULL) ? $request->ssect_div_id : NULL,
                'ssect_dir_id' => ($request->ssect_dir_id != NULL) ? $request->ssect_dir_id : NULL
            ]);

            return $this->response('berhasil', 'berhasil membuat data sub-section', $data, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal membuat data sub-section', $th->getMessage(), 400);
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

    public function deleteDivision(OrgSubSectMstr $ssectOid)
    {
        try {
            $ssectOid->update([
                'ssect_div_id' => NULL
            ]);

            return $this->response('berhasil', 'berhasil menghapus hirarki divisi', true, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal menghapus hirarki divisi', $th->getMessage(), 400);
        }
    }
}
