<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JwtMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd('a');
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'Token yang Anda gunakan tidak valid'], 401);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'Token Anda sudah kadaluarsa, silahkan login ulang'], 401);
        } catch (Exception $e) {
            return response()->json(['status' => 'Silahkan login terlebih dahulu'], 401);
        }
        return $next($request);
    }
}