<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PengajuanRequest;
use App\Models\{RekrutPengajuan, DptMstr};
use Carbon\Carbon;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengajuanRequest $request)
    {
        $count = RekrutPengajuan::count();
        ($count >= 1) ? $count++ : $count = 1;

        $base = '000';

        $funcAttachement = array_slice(str_split($base), 0, -strlen($count));
        $totalAttachement = implode($funcAttachement).$count;

        $funcDept = array_slice(str_split($base), 0, -strlen($request->dpt_id));
        $departement = implode($funcDept).$request->dpt_id;

        $pengajuan_code = 'PGJ-'.Carbon::now()->format('ym').$departement.$totalAttachement;
        dd($pengajuan_code);

        try {
            RekrutPengajuan::create([
                'pgj_code' => $pengajuan_code,
                'pgj_date' => Carbon::translateTimeString(now()),
                'pgj_alasan' => $request->alasan,
                ''
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RekrutPengajuan  $rekrutPengajuan
     * @return \Illuminate\Http\Response
     */
    public function show(RekrutPengajuan $rekrutPengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RekrutPengajuan  $rekrutPengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RekrutPengajuan $rekrutPengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RekrutPengajuan  $rekrutPengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RekrutPengajuan $rekrutPengajuan)
    {
        //
    }
}
