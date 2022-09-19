<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HRKeluarga;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{
    public function show($emp_id)
    {
        try {
            $data = HRKeluarga::where('hrkel_emp_id', $emp_id)->orderBy('hrkel_seq', 'ASC')->with('HRHubKel')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'success to get data',
                'data' => $data,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to get data',
                'error' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emp_id' => 'required',
            'hubId' => 'required',
            'nama' => 'required',
            'tglLahir' => 'required',
            'tmptLahir' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            $sequence = HRKeluarga::where('hrkel_emp_id', $request->emp_id)->count();

            if (!$sequence) {
                $sequence = 1;
            } elseif ($sequence == 5) {
                return response()->json([
                    'status' => 'redirected',
                    'pesan' => 'input sudah melebihi limit!',
                    'limit' => 5,
                    'code' => 300
                ], 300);
            } else {
                $sequence++;
            }

            $family = HRKeluarga::create([
                'hrkel_oid' => Str::uuid(),
                'hrkel_emp_id' => $request->emp_id,
                'hrkel_seq' => $sequence,
                'hrkel_hub_id' => $request->hubId,
                'hrkel_nama' => $request->nama,
                'hrkel_tgl_lahir' => $request->tglLahir,
                'hrkel_tempat_lahir' => $request->tmptLahir,
                'hrkel_remarks' => $request->remarks
            ]);

            return response()->json([
                'status' => 'berhasil',
                'pesan' => 'berhasil membuat data keluarga',
                'data' => $family,
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'gagal',
                'pesan' => 'gagal membuat data keluarga',
                'galat' => $th->getMessage(),
                'code' => 400
            ], 400);
        }
    }
}
