<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Token;
// use PHPOpenSourceSaver\JWTAuth\JWTAuth;

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

    public function profile()
    {
        try {
            // dd(JWTAuth::parseToken());

            $user = Auth::user();

            return response()->json([
                'status' => 'success',
                'message' => 'success to get profile',
                'profile' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to get profile',
                'error' => $th->getMessage()
            ], 400);
        }
    }

    public function logout()
    {
        try {
            JWTAuth::parseToken()->invalidate(true);

            return response()->json([
                'status' => 'success',
                'message' => 'logged out!',
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to logout',
                'error' => $th->getMessage()
            ], 400);
        }
    }

    public function userLogin(UserLoginRequest $request)
    {
        try {

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
