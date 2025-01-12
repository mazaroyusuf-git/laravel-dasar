<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller
{
    //sebelum nya kita melakukan redirect di Route, Response juga bisa melakukan Redirect menggunakan Illuminate\Http\RedirectResponse
    //kita bisa menggunakan method redirect(tujuan)
    public function redirectTo(): string
    {
        return "Redirect To";
    }

    public function redirectFrom(): RedirectResponse
    {
        return redirect("/redirect/to");
    }

    //sebelum nya di Route kita bisa Redirect menggunakan name dari path Route lain, di RedirectResponse juga bisa menggunakan method
    //route(name, params), jangan lupa kita perlu tentukan name nya di Route nya
    public function redirectName(): RedirectResponse
    {
        return redirect()->route("redirect-hello", ["name" => "yusuf"]);
    }

    //kita juga bisa melakukan redirect ke Controller langsung lain atau controller ini, 
    //kita bisa gunakan method action([controllerclass, namaMethod], [params]) di RedirectResponse
    public function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, "redirectHello"], ["name" => "yusuf"]);
    }

    public function redirectHello(string $name): string
    {
        return "Hello " . $name;
    }

    //kita juga bisa melakukan redirect ke domain lain atau website line dengan method away(url) di RedirectResponse
    public function redirectAway(): RedirectResponse
    {
        return redirect()->away("https://youtube.com/");
    }
}
