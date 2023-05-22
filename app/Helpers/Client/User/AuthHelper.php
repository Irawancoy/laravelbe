<?php 
namespace App\Helpers\Client\User;

use App\Models\Client\UserModel as User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\client\User\UserResource;

class AuthHelper extends User
{
     public static function register($email, $password, $nama, $no_hp)
     {
          $payload=[
               'email'=>$email,
               'password'=>Hash::make($password),
               'nama'=>$nama,
               'no_hp'=>$no_hp
          ];
          $user=self::create($payload);
          return $user;
     }
    
     public static function login($email,$password)
     {
         try {
             $credentials = ['email' => $email, 'password' => $password];
             if (!$token = auth()->guard('client')->attempt($credentials)) {
                 return [
                     'status' => false,
                     'error' => ['Kombinasi email dan password yang kamu masukkan salah']
                 ];
             }
         } catch (JWTException $e) {
             return [
                 'status' => false,
                 'error' => ['Could not create token.']
             ];
         }
         return [
             'status' => true,
             'data' => self::createNewToken($token)
         ];
     }
     
     public static function createNewToken($token)
     {
         return [
             'token' => $token,
             'token_type' => 'bearer',
             'user' =>new UserResource (auth()->guard('client')->user())
         ];
     }
     
}

