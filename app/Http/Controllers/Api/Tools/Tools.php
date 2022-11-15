<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Tools extends Controller
{
    public function response($status = 'success', $message = 'success!', $result = true, $code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'result' => $result,
        ], $code);
    }
}
