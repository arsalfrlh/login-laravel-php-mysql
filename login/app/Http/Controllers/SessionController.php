<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    public function index(){
        return view("sesi.login");
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'email tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong',
        ]);

        $cek_login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($cek_login)){
            return redirect('/dashboard')->with('login', Auth::user()->name . ' Anda Berhasil Login, Selamat Datang');
        }else{
            return redirect("/login")->with('gagal','Username atau Password Anda Salah');
        }
    }

    public function dashboard(){
        return view('sesi.dashboard');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login')->with('logout','Berhasil Logout');
    }

    public function register(){
        return view('sesi.register');
    }

    public function create(Request $request){
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users', //cek email tidak boleh sama di tabel users pada database
            'password' => 'required|min:3',
        ],[
            'nama.required' => 'nama tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
            'email.email' => 'Silahkan masukan email yang valid',
            'email.unique' => 'Email Sudah pernah digunakan',
            'password.required' => 'password tidak boleh kosong',
            'password.min' => 'password minimal 3 karakter',
        ]);

        $register = [
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password) //untuk enkripsi password
        ];
        User::create($register);

        $cek_login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($cek_login)){
            return redirect('/dashboard')->with('login', Auth::user()->name. 'Anda Berhasil Register, Selamat Datang'); //memanggil nama user di pesan ketika berhasil register
        }else{
            return redirect("/login")->with('gagal','Username atau Password Anda Salah');
        }
    }
}
