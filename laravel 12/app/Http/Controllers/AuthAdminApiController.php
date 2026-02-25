<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthAdminApiController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['message' => $validator->errors()->all(), 'success' => false]);
        }

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //karna nama di guardsnya itu admin maka kita pakai seperti ini
        if(Auth::guard('admin')->attempt($login)){
            $data = [
                'name' => Auth::guard('admin')->user()->name,
                'token' => Auth::guard('admin')->user()->createToken('auth-token')->plainTextToken
            ];
            

            return response()->json(['message' => "Login berhasil", 'success' => true, 'data' => $data]);
        }else{
            return response()->json(['message' => "Email atau Password anda salah", 'success' => false]);
        }

        //atau bisa dibuat seperti ini
        // if(auth('admin')->attempt($login)){
        //     $data = [
        //         'name' => auth('admin')->user()->name,
        //         'token' => auth('admin')->user()->createToken('auth-token')->plainTextToken
        //     ];

        //     return response()->json(['message' => "Login berhasil", 'success' => true, 'data' => $data]);
        // }else{
        //     return response()->json(['message' => "Email atau Password anda salah", 'success' => false]);
        // }
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:admin',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['message' => $validator->errors()->all(), 'success' => false]);
        }

        $admin = Admin::create($request->all());
        $data = [
            'name' => $admin->name,
            'token' => $admin->createToken('auth-token')->plainTextToken
        ];

        return response()->json(['message' => "Register berhasil", 'success' => true, 'data' => $data]);
    }
}
