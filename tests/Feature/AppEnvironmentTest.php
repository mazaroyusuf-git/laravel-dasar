<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AppEnvironmentTest extends TestCase
{
    public function testAppEnfv()
    {
        //kita bisa menentukan aplikasi berjalan di environment mana
        //dengan mengubah APP_ENV di .env default nya adalah local
        //kita bisa ganti contoh ke prod atau dev, kita bisa mengecek 
        //app env sekarang dengan static method App::environment(), jika
        //tanpa param akan kembalikan env saat ini
        //kita juga bisa menambahkan parameter env lebih dari satu
        if(App::environment("testing")) {
            self::assertTrue(true);
        }

    }
}
