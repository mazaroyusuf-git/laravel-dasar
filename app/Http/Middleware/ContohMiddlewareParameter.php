<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContohMiddlewareParameter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    //ketika ingin menambahkan dependency di middleware kita bisa gunakan DI di laravel, namun ketika kita hanya ingin
    //mengirimkan parameter sederhana kita hanya perlu menambahkan paramter tambahan tersebut sesudah Closure, untuk memberi 
    //value ke parameter nya kita bisa lakukan di Route di method middleware([aliasMiddleware:Param1,Param2]) untuk group di
    //Kernel harus buat alias nya di routeMiddleware baru bisa pakai di group dengan 'aliasMiddleware:Param1,Param2' dengan 
    //kata lain pastika terdaftar dahulu middleware nya di routeMiddleware
    public function handle(Request $request, Closure $next, string $key, int $status)
    {
        $apiKey = $request->header("X-API-KEY");
        if ($apiKey == $key) {
            return $next($request);
        } else {
            return response("Access Denied", $status);
        }
    }

    //kita bisa mengexclude Middleware di Route menggunakan method withoutMiddleware(pathMiddleware atau aliasnya)
}
