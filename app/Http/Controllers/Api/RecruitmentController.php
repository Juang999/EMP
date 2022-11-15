<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecruitmentRequest;
use App\Models\{RekrutPelamar, RekrutGendPlm, RekrutPelamarBahasa, RekrutPelamarOrganisasi, RekrutPelamarKeterampilan, RekrutPelamarPendidikan, RekrutPelamarPengalaman, RekrutPelamarSaudara};

class RecruitmentController extends Controller
{
    public $RekrutPelamar;

    public function __construct()
    {
        $this->RekrutPelamar = new RekrutPelamar;
    }

    public function store(RecruitmentRequest $request)
    {
        $total = $this->RekrutPelamar->count();

        if (str_contains(implode($this->RekrutPelamar->latest()->first()), $total) == true ) {
            $total += 1;
        } elseif (str_contains(implode($this->RekrutPelamar->latest()->first()), ($total += 1)) == true) {
            $total += 2;
        } else {
            $total = 1;
        }

        $base = '0000';

        $func = array_slice(str_split($base), 0, -strlen($total));
        $data = implode($func).$total;

        try {
            $pelamar = RekrutPelamar::create([
                'plm_code' => 'RCT.'.Carbon::now()->format('m.y').'.'.$data,
                'plm_date' => Carbon::translateTimeString(now()),
                'plm_nama' => $request->plm_nama,
                'plm_posisi' => $request->plm_posisi,
                'plm_tmpt_lahir' => $request->plm_tmpt_lahir,
                'plm_tgl_lahir' => $request->plm_tgl_lahir,
                'plm_suku' => $request->plm_suku,
                'plm_gol_darah' => $request->plm_gol_darah,
                'plm_tinggi' => $request->plm_tinggi,
                'plm_berat' => $request->plm_berat,
                'plm_jenis_kelamin' => $request->plm_jns_kelamin,
                'plm_telepon' => $request->plm_telepon,
                'plm_hobi' => $request->plm_hobi,
                'plm_alamat' => $request->plm_alamat,
                'plm_kota' => $request->plm_kota,
                'plm_propinsi' => $request->plm_propinsi,
                'plm_anak_ke' => $request->plm_anak_ke,
                'plm_anak_dari' => $request->plm_anak_dari,
                'plm_cita_cita' => $request->plm_cita_cita,
                'plm_status_marital' => $request->plm_status->marital,
                'plm_jml_anak' => $request->plm_jml_anak ? $request->plm_jml_anak : 0,
                'plm_status_rumah' => $request->plm_status_rumah,
                'plm_kendaraan' => $request->plm_kendaraan,
                'plm_sim' => $request->plm_sim,
                'plm_ayah' => $request->plm_ayah,
                'plm_ibu' => $request->plm_ibu,
                'plm_add_date' => Carbon::translateTimeString(now()),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
