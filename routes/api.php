<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\LayananController;
use App\Http\Controllers\Api\Admin\MenuController;
use App\Http\Controllers\Api\Admin\KategoriMenuController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\RekapController;
use App\Http\Controllers\client\AuthCustomerController ;
use App\Http\Controllers\Api\Admin\SliderController;
use App\Http\Controllers\Api\Admin\ProsedurController;
use App\Http\Controllers\Client\KeranjangController;
use App\Http\Controllers\Client\UserController as ClientUserController;
use App\Http\Controllers\Api\Admin\TentangKamiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('v1')->group(function () {
    Route::prefix('admin/auth')->group(function () {

        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/profile', [AuthController::class, 'profile'])->middleware('jwt.auth');
     
    });
    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::prefix('admin')->group(function () {


            Route::get('/home', [DashboardController::class, 'index']);
     
                Route::get('/layanan', [LayananController::class, 'index']);
                Route::post('/layanan', [LayananController::class, 'store']);
                Route::get('/layanan/{id}', [LayananController::class, 'show']);
                Route::put('/layanan/{id}', [LayananController::class, 'update']);
                Route::delete('/layanan/{id}', [LayananController::class, 'destroy']);

                Route::get('/menu', [MenuController::class, 'index']);
                Route::post('/menu', [MenuController::class, 'store']);
                Route::get('/menu/{id}', [MenuController::class, 'show']);
                Route::put('/menu/{id}', [MenuController::class, 'update']);
                Route::delete('/menu/{id}', [MenuController::class, 'destroy']);

                Route::get('/user', [UserController::class, 'index']);
                Route::post('/user', [UserController::class, 'store']);
                Route::get('/user/{id}', [UserController::class, 'show']);
                Route::put('/user/{id}', [UserController::class, 'update']);
                Route::delete('/user/{id}', [UserController::class, 'destroy']);

                Route::get('/slider', [SliderController::class, 'index']);
                Route::post('/slider', [SliderController::class, 'store']);
                Route::get('/slider/{id}', [SliderController::class, 'show']);
                Route::put('/slider/{id}', [SliderController::class, 'update']);
                Route::delete('/slider/{id}', [SliderController::class, 'destroy']);

                Route::get('/prosedur', [ProsedurController::class, 'index']);
                Route::post('/prosedur', [ProsedurController::class, 'store']);
                Route::get('/prosedur/{id}', [ProsedurController::class, 'show']);
                Route::put('/prosedur/{id}', [ProsedurController::class, 'update']);
                Route::delete('/prosedur/{id}', [ProsedurController::class, 'destroy']);

                Route::get('/tentang-kami', [TentangKamiController::class, 'index']);
                Route::post('/tentang-kami', [TentangKamiController::class, 'store']);
                Route::get('/tentang-kami/{id}', [TentangKamiController::class, 'show']);
                Route::put('/tentang-kami/{id}', [TentangKamiController::class, 'update']);
                Route::delete('/tentang-kami/{id}', [TentangKamiController::class, 'destroy']);





                
          Route::get('/rekap-transaksi', [RekapController::class, 'rekapTransaksi']);
                

        });

            
    
    });
    Route::prefix('client/auth')->group(function () {

        Route::post('/register', [AuthCustomerController::class, 'register']);
        Route::post('/login', [AuthCustomerController::class, 'login']);
        Route::post('/logout', [AuthCustomerController::class, 'logout']);
        Route::post('/refresh', [AuthCustomerController::class, 'refresh']);
        Route::get('/profile', [AuthCustomerController::class, 'profile'])->middleware('auth.api');

        
     
    });
  

    Route::group(['middleware' => ['auth.api']], function () {
        Route::prefix('client')->group(function () {

            Route::put('/user/{id}', [ClientUserController::class, 'update']);
Route::get ('/slider', [SliderController::class, 'index']);

Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'show']);

Route::get('/layanan', [LayananController::class, 'index']);
Route::get('/layanan/{id}', [LayananController::class, 'show']);

Route::get('/prosedur', [ProsedurController::class, 'index']);

Route::get('/tentang-kami', [TentangKamiController::class, 'index']);

Route::post('keranjang', [KeranjangController::class, 'addTocart']);
Route::delete('keranjang/{cartId}', [KeranjangController::class, 'removeFromCart']);
Route::delete('keranjang/clear/{userId}', [KeranjangController::class, 'clearCart']);
Route::get('keranjang/{userId}', [KeranjangController::class, 'getCartItems']);
Route::get('keranjang/total-price/{userId}', [KeranjangController::class, 'calculateTotalPrice']);






});

});
});

