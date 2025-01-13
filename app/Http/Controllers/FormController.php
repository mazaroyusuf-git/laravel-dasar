<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FormController extends Controller
{
    //di laravel ada fitur security CSRF untuk melindungi post dari Website lain, CSRF mewajibkan mengirim token
    //pada saat kita melakukan POST ke aplikasi kita, saat melakukan POST kita perlu mengirim juga token yang diketahui aplikasi
    //dan ketika submit menggunakan POST token tersebut dikirm juga ke aplikasi kita, jika invalid maka akan di reject

    //untuk membuat token kita perlu menggunakan function csrf_token() contoh nya bisa lihat di resource/view/form.blade.php
    //setiap kita mengakses web laravel, laravel akan menjalankan session dan akan menyimpan csrf token, token tersebut perlu
    //disertakan di input, laravel akan mengecek token melalui input name _token contoh nya bisa lihat di resource/view/form.blade.php
    public function form(): Response
    {
        return response()->view("form");
    }

    public function submitForm(Request $request): Response
    {
        $name = $request->input("name");
        return response()->view("hello", ["name" => $name]);
    }
}
