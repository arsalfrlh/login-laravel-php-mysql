<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login',[SessionController::class,'login'])->name('login');
    Route::post('/login/proses',[SessionController::class,'login_proses']);
    Route::get('/register',[SessionController::class,'register']);
    Route::post('/register/proses',[SessionController::class,'register_proses']);
});

Route::middleware(['guest:admin'])->group(function(){
    Route::get('/login/admin',[AuthAdminController::class,'login']);
    Route::post('/login/admin/proses',[AuthAdminController::class,'loginProses']);
    Route::get('/register/admin',[AuthAdminController::class,'register']);
    Route::post('/register/admin/proses',[AuthAdminController::class,'registerProses']);
});

Route::get('/home',function(){
    return redirect('/index');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/index',[SessionController::class,'index']);
    Route::get('/logout',[SessionController::class,'logout']);
});

Route::middleware(['auth:admin'])->group(function(){ //harus tambahkan admin karena login dgn provider admin Auth::guard('admin')->attempt($login)
    Route::get('/index/admin',[AuthAdminController::class,'index']);
    Route::get('/logout',[SessionController::class,'logout']);
});