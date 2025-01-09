<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    //saat kita menaruh semua logic atau closure function di Route dengan jumlah yang banyak
    //di maintain nya akan sangat membingungkan, kita bisa menyimpan logic2 yang
    //di route ke dalam Controller

    //Controller mendukung Dependency Injection, kita bisa menambahkan dependency
    //yang dibutuhkan karena pembuatan object Controller dibuat
    private HelloService $helloService;

    public function __construct(HelloService $helloService)
    {
        //otomatis HelloService akan diambil oleh ServiceProvider
        $this->helloService = $helloService;
    }

    //biasanya di PHP ketika kita ingin mendapatkan info tentang request nya
    //kita menggunakan global var seperti $_GET dan $_POST, di laravel kita hanya
    //perlu menggunakan object Request yang ada pada Illuminate\Http\Request
    //kita bisa menambahkan object Request pada parameter router atau controller
    //otomatis laravel akan melakukan dependency injeksi data request tsb
    public function hello(Request $request, string $name): string
    {
        //kita bisa mengambil beberapa informasi dari Request seperti
        $request->path();
        $request->url();
        $request->fullUrl();
        $request->method();
        $request->isMethod("get");
        return $this->helloService->hello($name);
    }

    public function request(Request $request): string
    {
        return$request->path() . PHP_EOL . 
        $request->url() . PHP_EOL . 
        $request->fullUrl() . PHP_EOL . 
        $request->method() . PHP_EOL . 
        $request->header("Accept") . PHP_EOL;
    }
}
