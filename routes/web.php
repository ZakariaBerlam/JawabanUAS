<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasanganController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[LoginController::class,'defaultpage']);
Route::get('/home',[LoginController::class,'Home']);
Route::get('/register', function () {
    return view('Register');
});

Route::post('/register', [LoginController::class,'Register']);

Route::get('/login', function () {
    return view('LogIn');
});
Route::post('/login', [LoginController::class,'LogIn']);
Route::get('/LogOut',[LoginController::class,'LogOut']);
Route::get('/register/payment', function () {
    return view('payment');
});
Route::post('/payment/{id}', [LoginController::class,'pembayaran']);
route::get('/payment/save/{yaya}',[LoginController::class,'simpen']);
Route::get('/match/{name}',[PasanganController::class,'nembak'])->middleware('auth');
Route::get('/Matches',[PasanganController::class,'Showmatch'])->middleware('auth');
Route::get('/match/accept/{id}',[PasanganController::class,'terima'])->middleware('auth');
Route::get('/match/reject/{id}',[PasanganController::class,'tolak'])->middleware('auth');
Route::get('/show/L',[LoginController::class,'ShowGender1']);
Route::get('/show/P',[LoginController::class,'ShowGender2']);
Route::put('/user/top-up', [LoginController::class,'topup']);
