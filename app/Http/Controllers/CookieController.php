<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    //kita juga bisa membuat cookie dengan object Response untuk misal manajemen session, secara default cookie di laravel akan
    //di enkripsi secara otomatis hal ini dilakukan di App\Http\Middleware\EncryptCookies, jika ada cookie yang tidak mau kita enkripsi
    //kita bisa menambahkan namanya di var $except dalam App\Http\Middleware\EncryptCookies
    public function createCookie(Request $request): Response
    {
        //untuk membuat cookies kita bisa gunakan method cookie(name, value, timeout, path, domain, secure, httpOnly)
        return response("Hello Cookie")
            ->cookie("User-id", "yusuf", 1000, '/')
            ->cookie("Is-Member", "true", 1000, '/');
    }

    //kita bisa menangkapa atau mengambil data cookie nya dengan Request, kita bisa menggunakan method cookie(namaCookie, defaultValue)
    //untuk mengambil cookie nya, atau cookies->all() untuk mengambil semua cookie
    public function getCookie(Request $request): JsonResponse
    {
        return response()->json([
            "userId" => $request->cookie("User-Id", "guest"),
            "isMember" => $request->cookie("Is-Member", "false")
        ]);
    }

    //tidak ada cara untuk menghapus cookie, kita bisa overwrite cookie yang sudah ada dengan value kosong atau timeout yang cepat
    //kita bis alakukan ini dengan method withoutCookie(name)
    public function clearCookie(Request $request): Response
    {
        return response("Clear Cookie")
            ->withoutCookie("User-Id")
            ->withoutCookie("Is-Member");
    }
}
