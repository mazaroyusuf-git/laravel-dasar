<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        //semua data input dari user bisa kita tangkap dengan object Request
        //kita bisa menggunkan method input(key, default)

        //method input bisa mengambil value dari query param dan body
        $name = $request->input("name");
        return "Hello " . $name;
    }

    //ketika kita ingin mengakses data atau value yang nested misal didalam sebuah object json
    //kita bisa menggunakan titik . untuk mengakses nya
    public function helloFirst(Request $request): string
    {
        $firstname = $request->input("name.first");
        return "Hello " . $firstname;
    }

    //kita bisa mengambil input dengan method input() tanpa parameter
    public function helloInput(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }

    //kita bisa mengambil input dari sebuah array dengan menggunakan tanda *, artiny akita mengambil semua data yang ada pada products
    //dengan key name
    public function arrayInput(Request $request): string
    {
        $input = $request->input("products.*.name");
        return json_encode($input);
    }

    //kita bisa mengambil data di query parameter dengan method query(key) atau jika bentuknya array query()

    //kita bisa melakukan konversi tipe data input ke Boolean dengan menggunakan method boolean(key, default)
    //dan kita bisa konversi tipe data date dengan menggunakan date(key, pattern, timezone) laravel menggunakan
    //library https://github.com/briannesbitt/Carbon untuk manipulasi Date and Time
    public function InputType(Request $request): string
    {
        $name = $request->input("name");
        $married = $request->boolean("married");
        $birthDate = $request->date("birth_date", "Y-m-d");

        return json_encode([
            "name" => $name,
            "married" => $married,
            "birth_date" => $birthDate->format("Y-m-d")
        ]);
    }

    //kita bisa melakukan filtering ke key yang di input user, akan bahaya jika kita mengupdate key yang salah
    //ke dalam database, kita bisa gunakan method only([key1, key2,..]) yang berguna untuk hanya mengambil input yang
    //ada di parameter, atau kita bisa gunakan except([key1, key2,..]) yang berguna mengambil semua key kecuali yang ada di parameter
    public function filterOnly(Request $request): string
    {
        $name = $request->only(["name.first", "name.last"]);
        return json_encode($name);
    }

    public function filterExcept(Request $request): string
    {
        $user = $request->except(["admin"]);
        return json_encode($user);
    }

    //kita bisa mengirimkan sebuah default input value ketika input tersebut tidak dikirm di request, kita bisa gunakan
    //method merge(array) jika ada key yang sama maka akan di timpa, atau mergeIfMissing(array) jika ada key yang sama maka akan di batalkan
    public function filterMerge(Request $request): string
    {
        $request->merge(["admin" => "false"]);
        $user = $request->input();
        return json_encode($user);
    }
}
