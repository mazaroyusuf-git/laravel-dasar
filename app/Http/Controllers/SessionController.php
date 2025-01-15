<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    //laravel menyediakan absraction layer untuk mengelola session nya, tidak perlu lagi menggunakan PHP Session.

    //konfigurasi session di laravel disimpan di config/session.php, untuk mengubah jenis penyimpanan nya kita bisa
    //ubah bagian Session Driver, default nya adalah file, env nya juga perlu diubah ketika ingin mengganti tipe
    //penyimpanan, kita bisa melihat tipe penyimpanan apa saja yang bisa di bagian Supported pada Default Session
    //Driver.

    //session di representasikan dalam interface Illuminate\Contracts\Session, ada banyak cara mendapatkan object Session
    //kita bisa menggunakan method session() pada Request atau helper method session() atau juga facade Session
    //https://laravel.com/api/9.x/Illuminate/Contracts/Session/Session.html 

    //kalau session disimpan dalam file, akan disimpan di storage/framework/session

    public function createSession(Request $request): string
    {
        $request->session()->put("userId", "yusuf");
        $request->session()->put("isMember", "true");

        return "OK";
    }

    public function getSession(Request $request): string
    {
        $userId = $request->session()->get("userId");
        $isMember = $request->session()->get("isMember");

        return "User Id : ${userId}, Is Member : ${$isMember}";
    }
}
