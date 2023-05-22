<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Closure;
use DateTime;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function handle($request, Closure $next)
    // {
    //     try {
    //         $userModel = JWTAuth::parseToken()->authenticate();
    //         $userToken = JWTAuth::parseToken()->getPayload()->get('user');

    //         $updatedDb = new DateTime($userModel->updated_security);
    //         $updatedToken = new DateTime($userToken->updated_security);

    //         // Cek jika ada perubahan pengaturan keamanan, user harus login ulang
    //         if ($updatedDb > $updatedToken) {
    //             return response()->failed(['Terdapat perubahan pengaturan keamanan, silahkan login ulang'], 403);
    //         }

    //     } catch (Exception $e) {
    //         if ($e instanceof TokenInvalidException) {
    //             return response()->failed(['Token yang anda gunakan tidak valid'], 403);
    //         } elseif ($e instanceof TokenExpiredException) {
    //             return response()->failed(['Token anda telah kadaluarsa, silahkan login ulang'], 403);
    //         } else {
    //             return response()->failed(['Silahkan login terlebih dahulu. '. $e->getMessage()], 403);
    //         }
    //     }


    //     return $next($request);
    // }
}