<?php

use App\Http\Controllers\SessionController;
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

Route::get('/', function () {
    return view('welcome');
});

//user bisa bisa mengakses halaman ini ketika belum login atau register
//jika user sudah login atau register dan mengaksesnya maka user akan di arahkan ke halaman home
Route::middleware(['guest'])->group(function(){
    Route::get('/login',[SessionController::class,'index'])->name('login'); //name route digunakan untuk user belum login dan mencoba mengakses dashboard dan akan di alihkan ke login
    Route::post('/login/proses',[SessionController::class,'login']);
    Route::get('/register',[SessionController::class,'register']);
    Route::post('/register/proses',[SessionController::class,'create']);
});
//halaman home akan di arahkan ke halaman dashboard
Route::get('/home',function(){
    return redirect('/dashboard');
});

//jika user belum login atau register dan mencoba mengakses halaman dashboard maka akan di alihkan ke route yang bernama login
Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard',[SessionController::class,'dashboard']);
    Route::get('/logout',[SessionController::class,'logout']);
});