<?php

namespace Modules\Recruitment\Http\Controllers\Api\Client;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\CodeMaster;
use App\Http\Controllers\Traits\Tools;
use Illuminate\Support\Facades\DB;

class GetLocationController extends Controller
{
    use Tools;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $data = DB::table('public.code_mstr')->select('code_name AS label')->where('code_field', 'area_id')->get();

            return $this->response('berhasil', 'berhasil mengambil data area', $data, 200);
        } catch (\Throwable $th) {
            return $this->response('gagal', 'gagal mengambil data', $th->getMessage(), 400);
        }
    }
}
