<?php

namespace Tests\Feature;

use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testEnv()
    {
        //untuk menggunakan environment yang berbeda pada saat develop menggunakan
        //larave, kita jangan menghardcode value env nya di kode, kita bisa gunakan
        //class Env lalu gunakan static method get("key"), atau gunakan,
        //env("key")

        //kita harus membuat env dulu sebelum melakukan ini lihat di udemy laravel
        //Environment, kita bisa menambahkan key value env di .env
        $appName = env("BELAJAR_LARAVEL");

        self::assertEquals("LARAVELSIAP", $appName); 
    }

    public function testEnvDefault()
    {
        //jika value yang kita cari tidak ada kita bisa set default valuenya
        //di parameter kedua
        $author = env("AUTHOR", "YUSUF");

        self::assertEquals("YUSUF", $author);
    }
}
