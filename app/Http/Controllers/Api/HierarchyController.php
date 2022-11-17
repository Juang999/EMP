<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRHirarki;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HierarchyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $hirarki = HRHirarki::get();

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengambil data',
                'data' => $hirarki
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal mengambil data',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hirarkiLatestData = HRHirarki::orderBy('id', 'DESC')->first('id');

        if ($hirarkiLatestData == NULL) {
            $hirarkiLatestData->id = 1;
        }

        try {
            $hirarki = HRHirarki::create([
                'id' => $hirarkiLatestData->id += 1,
                'code' => 'HRK-'.strval($hirarkiLatestData->id),
                'description' => $request->description,
                // 'parent' => $request->parent,
                'add_by' => Auth::user()->usernama,
                'add_date' => Carbon::translateTimeString(now()),
                // 'inisial_jabatan' => $request->inisial_jabatan,
                // 'status_posisi' => $request->status_posisi,
                'en_id' => $request->enId
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil mengiinputkan data hirarki',
                'data' => $hirarki
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal membuat data',
                'galat' => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
