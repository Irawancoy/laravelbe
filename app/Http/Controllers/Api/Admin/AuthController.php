<?php
namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Admin\User\AuthHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\User\AuthRequest;
use App\Http\Resources\admin\User\UserResource;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        // dd('a');
         /**
         * Menampilkan pesan error ketika validasi gagal
         * pengaturan validasi bisa dilihat pada class app/Http/request/User/UpdateRequest
         */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');
        $login = AuthHelper::login($credentials['email'], $credentials['password']);
// dd('a');
        if(!$login['status']) {
            return response()->failed($login['error'], 422);
        }

        return response()->success($login['data']);
    }

    /**
     * Logout user
     *
     * @return void
     */
    public function logout()
    {
        auth()->logout();
        
        return response()->success();
    }

    /**
     * Refresh token
     *
     * @return void
     */
    public function refresh()
    {

        return response()->success(auth()->user());
    }
   /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function profile()
    {
        return response()->success(new UserResource(auth()->user()));
    }

    /**
     * Get the csrf token
     *
     * @return [json] user object
     */
    public function csrf()
    {
        return response()->success(csrf_token());
    }
}


