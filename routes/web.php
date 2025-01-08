<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| baca ini
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
| kita bisa menggunakan Facades Route dan menggunakan method berikut untuk routing 
| applikasi kita, contoh Route::get($url, $callback atau closure yang akan dipanggil
| ketika route ini digunakan ada banyak post(), put(), patch(), delete(), options()
)
*/


//contoh membuat Route::get
Route::get('/', function () {
    return view('welcome');
});

Route::get("/yusuf", function () {
    return "Hello Yusuf";
});

//Routing juga bisa redirect, dengan cara Route::redirect(url, tujuan)
//ketika mengakses /akun akan langsung redirect ke /yusuf
Route::redirect("/akun", "/yusuf");


//kita bisa melihat semua routing kita dengan command php artisan route:list

//ketika kita ingin mengakses route yang tidak ada otomatis kita akan dapat kode 
//404, kita bisa modifikasi halaman 404 dengan static method fallback

Route::fallback(function () {
    return "404 Halaman tidak ada";
});

//setelah kita membuat template view di ../resources/views kita perlu membuat render
//nya, dengan static method view atau dengan get juga bisa yang didalam nya ada method
//view

//Route::view($url, template, array data atau model nya yang akan dikirm ke var di template)
Route::view("/hello", "hello", ["name" => "yusuf"]);

//dengan get($url, closure atau callback)
Route::get("/hello-again", function () {
    //jika pakai method http kita tidak perlu lagi memasukkan url nya di method view
    return view("hello", ["name" => "yusuf"]);
});

//ketika kita ingin mengakses template yang berada di folder lain dalam views
//dibandingkan kita menggunakan \ kita gunakan .
Route::get("/hello-world", function () {
    return view("hello.world", ["name" => "yusuf"]);
});

//ketika kita melakuka request secara tiba2 saat di production otomatis template
//view akan di compile dan memakan proses lama jika template banyak, ada baik nya kita
//melakukan compile dari awal sebelum aplikasi nyala agar tidak menggangu performa
//saat live, kita bisa gunakan command php artisan view:cache dan unutk menghapus
//php artisan view:clear

