<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    public function login(){
        return view('sesi.login');
    }

    public function login_proses(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($login)){
            return redirect('/index');
        }else{
            return redirect('/login');
        }
    }

    public function register(){
        return view('sesi.register');
    }

    public function register_proses(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password required',
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $register = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($register)){
            return redirect('/index');
        }else{
            return redirect('/login');
        }
    }

    public function index(){
        return view('sesi.index');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
