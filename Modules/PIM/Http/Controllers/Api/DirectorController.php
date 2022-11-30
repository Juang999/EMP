<?php

namespace Modules\PIM\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PIM\Entities\OrgDirMstr;
use Illuminate\Support\Facades\Auth;
use Modules\PIM\Http\Requests\DirectorRequest;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            $data = OrgDirMstr::get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengmbil data',
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

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(DirectorRequest $request)
    {
        try {
            $dir_id = (OrgDirMstr::orderBy('dir_id', 'DESC')->first() == NULL) ? 1 : OrgDirMstr::orderBy('dir_id', 'DESC')->first()['dir_id'] + 1;

            $data = OrgDirMstr::create([
                'dir_oid' => Str::uuid(),
                'dir_add_by' => Auth::user()->usernama,
                'dir_add_date' => Carbon::now()->locale('Id'),
                'dir_id' => $dir_id,
                'dir_dom_id' => $request->dir_dom_id,
                'dir_en_id' => $request->dir_en_id,
                'dir_code' => $request->dir_code,
                'dir_desc' => $request->dir_desc,
                'dir_lbr_cap' => 0,
                'dir_active' => 'Y',
                'dir_dt' => Carbon::now()
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat data direktur',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal membuat data',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
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
