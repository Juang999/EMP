<?php

namespace App\Http\Controllers\Temporary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CodeMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TemporaryInputController extends Controller
{
    public function inputCodeMaster(Request $request)
    {
        try {
            $beforeCodeId = CodeMaster::orderBy('code_id', 'DESC')->first('code_id');


            $codeId = $beforeCodeId->code_id + 1;

            $sequence = CodeMaster::where('code_field', $request->field)->count();

            if (!$sequence) {
                $sequence = 1;
            } else {
                $sequence++;
            }

            $data = CodeMaster::create([
                'code_oid' => Str::uuid(),
                'code_dom_id' => 1,
                'code_add_by' => Auth::user()->usernama,
                'code_add_date' => Carbon::translateTimeString(now()),
                'code_id' => $codeId,
                'code_seq' => $sequence,
                'code_field' => $request->field,
                'code_code' => $request->code,
                'code_name' => $request->name,
                'code_desc' => $request->desc,
                'code_default' => 'N',
                'code_active' => 'Y',
                'code_dt' => Carbon::translateTimeString(now())
            ]);

            return response()->json([
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal membuat code',
                'galat' => $th->getMessage()
            ], 400);
        }
    }
}
