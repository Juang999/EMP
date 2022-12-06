<?php

namespace Modules\Recruitment\Http\Controllers\Api\Client;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PIM\Entities\OrgDptMstr;
use App\Http\Controllers\Traits\Tools;
use Illuminate\Support\Facades\DB;

class GetDepartementController extends Controller
{
    use Tools;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $data = DB::table('public.orgdpt_mstr')->select('dpt_desc AS label')->get();

            return $this->response('berhasil', 'berhasil mengambil data', $data, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal mengambil data', $th->getMessage(), 400);
        }
    }
}
