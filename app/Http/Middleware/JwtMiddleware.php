<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json([
                    'code' => 403,
                    'status' => 'Token is Invalid'
                ], 403);
            }else if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json([
                    'code' => 419,
                    'status' => 'Token is Expired'
                ], 419);
            }else{
                return response()->json([
                    'code' => 401,
                    'status' => 'Authorization Token not found'
                ], 401);
            }
        }
        return $next($request);
    }
}
