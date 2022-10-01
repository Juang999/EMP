<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRKeluarga;
use Illuminate\Http\Request;

class UpdateCenter extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $mode, $emp_id)
    {
        switch ($mode) {
            case 'anggotaKeluarga':
                HRKeluarga::where('hrkel_emp_id', $emp_id)->update([
                    'hrkel_'
                ]);
                break;

            default:
                # code...
                break;
        }
    }
}
