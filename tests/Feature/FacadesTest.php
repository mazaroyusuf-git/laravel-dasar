<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadesTest extends TestCase
{
    //kadang kita tidak selalu bisa menggunakan object Application untuk misal
    //Dependency Injection di class yang bukan bawaan fitur laravel, pada kasus
    //ini Facades sangat membantu, Facades adalah class yang menyediakan static
    //access ke fitur di ServiceContainer atau Application, ada di namespace
    //https://laravel.com/api/9.x/Illuminate/Support/Facades.html 

    //pakai Facades jika perlu2 saja jika bisa gunakan Application gunakanlah Application
    //method helper seperti env() dan config() berasal dari Facades

    public function testConfig()
    {
        $firstname1 = config("contoh.author.first");
        $firstname2 = Config::get("contoh.author.first");

        self::assertEquals($firstname1, $firstname2);

        var_dump(Config::all());
    }

    //semua class Facades adalah turunan dari class Facade yang memiliki magic method
    //__callStatic() yang digunakan unutk memanggil static method di Facade dan
    //akan secara otomatis meneruskannya ke dependency yang ada di ServiceContainer
    //Config::get() sebenarnya akan menamnggil method get() di ServiceContainer

    //unutk melihat nama dependency yang terdapat pada Container kita bisa menggunakan
    //getFacadeAccessor() pada class Facade

    public function testConfigDependency()
    {
        $config = $this->app->make("config");
        $firstname1 = $config->get("contoh.author.first");
        $firstname2 = Config::get("contoh.author.first");

        self::assertEquals($firstname1, $firstname2);

        var_dump(Config::all());
    }

    //untuk melakukan MockingTest untuk Facades biasanya sulit namun di Laravel
    //sudah disediakan Mocking di Facades menggunakan mockery/mockery
    //https://github.com/mockery/mockery 

    public function testConfigMock()
    {
        //arti dari kode dibawah adalah, ketika kita menerima method get
        //dengan parameter contoh.author.first kita return kan Yusuf
        Config::shouldReceive("get")
        ->with("contoh.author.first")
        ->andReturn("Yusuf");

        $firstname = Config::get("contoh.author.first");

        self::assertEquals("Yusuf", $firstname);
    }

    //hampir semua Facades di Laravel banyak menggunakan dependency di ServiceContainer
    //https://laravel.com/docs/9.x/facades#facade-class-reference 

}
