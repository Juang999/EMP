<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where([
                'usernama' => $request->usernama,
                'password' => $request->password
                ])->first();

            if(!$user){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'user '.$request->usernama.' not found!'
                ], 404);
            }

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'token' => $token
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to login',
                'error' => $th->getMessage()
            ], 400);
        }
    }

    public function user()
    {
        try {
            $user = User::get();

            return response()->json($user);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
