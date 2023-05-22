<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\client\User\AuthRequest;
use App\Helpers\Client\User\AuthHelper;
use App\Http\Requests\client\User\RegisterRequest;
use App\Http\Resources\client\User\UserResource;

class AuthCustomerController extends Controller
{
    public function login(AuthRequest $request)
    {
         /**
         * Menampilkan pesan error ketika validasi gagal
         * pengaturan validasi bisa dilihat pada class app/Http/request/User/UpdateRequest
         */
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');
        
       $login=AuthHelper::login($credentials['email'], $credentials['password']);
        if(!$login['status']) {
            return response()->failed($login['error'], 422);
        }
        return response()->success($login['data']);
    }
    public function register(RegisterRequest $request)
{
    /**
     * Menampilkan pesan error ketika validasi gagal
     * pengaturan validasi bisa dilihat pada class app/Http/request/User/RegisterRequest
     */
    if (isset($request->validator) && $request->validator->fails()) {
        return response()->failed($request->validator->errors(), 422);
    }

    $credentials = $request->only('email', 'password', 'nama', 'no_hp');
    $register = AuthHelper::register($credentials['email'], $credentials['password'], $credentials['nama'], $credentials['no_hp']);
  
  return response()->json([
        'status' => true,
        'data' => $register,
    ]);
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
    // public function refresh()
    // {
    //     return response()->success(auth()->user());
    // }
    public function profile()
    {
        $user = auth()->guard('client')->user();

    
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        return response()->success(new UserResource($user));
    }
    


}
