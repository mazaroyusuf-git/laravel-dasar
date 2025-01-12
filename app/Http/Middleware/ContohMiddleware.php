<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContohMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    //untuk membuat middleware kita bisa gunakan php artisan make:middleware namaMiddleware, Middlewware mendukung dependency Injection
    //Service Provider, di Middleware method yang penting adalah handle(request, closure) yang akan dipanggil sebelum request masuk ke
    //controller, kita bisa gunakan closure() untuk diteruskan ke controller, method handle() bisa kembalikan Response

    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header("X-API-KEY");
        if ($apiKey == "MYG") {
            //$next akan melanjutkan ke tahap selanjutnya
            return $next($request);
        } else {
            return response("Access Denied", 401);
        }
    }

    //setelah membuat middleware kita perlu registrasikan middleware ke laravel antara untuk global atau semua route atau route tertentu saja
    //kita bisa masukkan ke \app\Http\Kernel, untuk flobal kita bisa masukkan path middleware nya ke $middleware, untuk yang lebih route spesifik
    //kita bisa massukkan ke $routeMiddleware lalu buat alias nya seperti contoh auth.basic => pathMiddleware::class ketika kita mau panggil 
    //middleware ny akita cukup gunakan alias nya, lalu setelah itu kita bisa gunakan di Route dengan method middleware([pathMiddleware])

    //kita juga bisa menggunakan $middlewareGroup yaitu middleware yang digabungkan ke dalam group ketika ingin memakai nya kita hanya perlu
    //memanggil dengan nama group nya saja, misal "web" => [arrayPathMiddleware::class]
}
