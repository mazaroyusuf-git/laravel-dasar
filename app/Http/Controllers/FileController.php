<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //kita juga bisa menangkap Request yang pentuk nya file dengan Objecy Illuminate\Http\Request, kita bisa gunakan
    //method file(name nya), lalu kita bisa langsung menyimpannya dengan method storePubliclyAs(nama folder, nama file, nama storage sesuai di config)
    public function upload(Request $request): string
    {
        $picture = $request->file("picture");
        //atau kita bisa menggunakan method allFiles() untuk menerima semua request file
        $picture->storePubliclyAs("pictures", $picture->getClientOriginalName(), "public");

        return "OK : " . $picture->getClientOriginalName();
    }
}
