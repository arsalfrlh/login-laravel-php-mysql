<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function loginProses(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::guard('admin')->attempt($login)){
            return redirect('/index/admin')->with('success', Auth::guard('admin')->user()->name . ' Selamat datang anda berhasil login');
        }else{
            return redirect()->back()->with('error', "Email atau Password anda salah");
        }
    }

    public function register(){
        return view('auth.register');
    }

    public function registerProses(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admin',
            'password' => 'required'
        ]);

        $admin = Admin::create($request->all());
        Auth::guard('admin')->login($admin);
        return redirect('/index/admin')->with('success', Auth::guard('admin')->name . ' Selamat datang anda berhasil register');
    }

    public function index(){
        return view('auth.index');
    }
}
