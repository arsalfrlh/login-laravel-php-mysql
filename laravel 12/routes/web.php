<?php

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

Route::get('/home',function(){
    return redirect('/index');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/index',[SessionController::class,'index']);
    Route::get('/logout',[SessionController::class,'logout']);
});
