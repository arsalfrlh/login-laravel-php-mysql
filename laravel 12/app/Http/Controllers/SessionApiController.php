<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//gunakan ini untuk menggunakan route api dan tabel token di database = php artisan install:api
//gunakan ini untuk install sacntum = composer require laravel/sanctum

class SessionApiController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'Ada kesalahan', 'success' => false, 'data' => $validator->errors()]);
        }
        
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($login)){
            $data = [
                'token' => Auth::user()->createToken('auth_token')->plainTextToken, //import token di model "User" untuk membuat createToken
            ];
            return response()->json(['message' => 'Berhasil Login', 'success' => true, 'data' => $data]);
        }else{
            return response()->json(['message' => 'Username atau Password anda salah', 'success' => false, 'data' => null]);
        }
    }
    
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'Ada kesalahan', 'success' => false, 'data' => $validator->errors()]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $register = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($register)){
            $data = [
                'token' => $user->createToken('auth_token')->plainTextToken,
            ];
            return response()->json(['message' => 'Register berhasil', 'success' => true, 'data' => $data]);
        }else{
            return response()->json(['message' => 'Register gagal Username atau Password Salah', 'data' => null]);
        }
        
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout Berhasil', 'success' => true]);
    }
}
