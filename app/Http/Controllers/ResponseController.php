<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    //laravel juga menyediakan object untuk representasi Http Response yaitu Illuminate\Http\Response
    //jangan lupa return nya bisa dengan Response itu
    public function response(Request $request): Response
    {
        return Response("Hello Response");
    }

    //kita juga bisa menambahkan informasi response yang akan kita kirim dengan method response(content, status code, header)
    //atau kita bisa buat header nya secara terpisah dengan method withHeader(arrayheader) dan header(key, value)
    public function header(Request $request): Response
    {
        $body = ["firstname" => "Mazaro", "lastname" => "Yusuf"];
        return response(json_encode($body), 200)
            ->header("Content-Type", "application/json")
            ->withHeaders([
                "Author" => "Azam Yusuf",
                "App" => "Belajar laravel dasar"
            ]);
    }

    //Response sudah banyak menyediakan method untuk menampilkan berbagai tipe Response, seperti view(name, data, status, header) untuk tampilkan 
    //view, json(array, status, headers) untuk tampilkan json, file(pathToFile, headers) untuk tampilkan file, download(pathToFile, name, header)
    //untuk tampikan file yang di download, ingat harus sesuaikan dengan return Type
    public function responseView(): Response
    {
        return response()->view("Hello", ["name" => "Yusuf"]);
    }

    public function responseJson(): JsonResponse
    {
        $body = ["firstname" => "Mazaro", "lastname" => "Yusuf"];
        return response()->json($body);
    }

    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()->file(storage_path("app/public/pictures/gambar.jpeg"));
    }

    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()->download(storage_path("app/public/pictures/gambar.jpeg"), "gambar.jpeg");
    }
}
