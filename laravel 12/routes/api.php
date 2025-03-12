<?php

use App\Http\Controllers\SessionApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[SessionApiController::class,'login']);
Route::post('/register',[SessionApiController::class,'register']);
Route::middleware('auth:sanctum')->post('/logout',[SessionApiController::class,'logout']);
