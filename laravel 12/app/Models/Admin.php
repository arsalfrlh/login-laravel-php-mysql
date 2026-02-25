<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; //ini paling utama utk menandakan model Admin bisa Auth
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

//setelah semua ini tambahkan konfigurasi di file config/auth.php
class Admin extends Authenticatable //tambahkan ini
{
    use HasApiTokens, Notifiable; //tambahkan ini agar bisa buat token api sanctum| Notiable agar user bisa menerima notif laravel, otp, dll
    protected $table = "admin";
    protected $fillable = ['name','email','password'];

    protected $hidden = [ //hidden column ini
        'password',
        'remember_token'
    ];

    public function casts(){ //agar lansung dideklarasikan si columnya
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed'
        ];
    }
}
