<?php

namespace App\Http\Controllers\Traits;

/**
 *
 */
trait Tools
{
    public function response($status = 'berhasil', $pesan = 'berhasil!', $hasil = true, $code = 200)
    {
        return response()->json([
            'status' => $status,
            'pesan' => $pesan,
            'hasil' => $hasil,
            'code' => $code
        ], $code);
    }
}
