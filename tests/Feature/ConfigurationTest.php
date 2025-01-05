<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        //untuk membuat config bisa lihat caranya di udemy Laravel
        //Configuration chapter 14

        //kita bisa mengambil value dari config dengan cara
        //namaFile.key.key.key...

        $firstname = config("contoh.author.first");
        $lastname = config("contoh.author.last");
        $email = config("contoh.email");
        
        self::assertEquals("Yusuf", $firstname);
        self::assertEquals("Azam", $lastname);
        self::assertEquals("BelajarLaravel@gmail.com", $email);

        //ketika kita masuk ke tahap production alangkah
        //baik nya semua config di simpan ke dalam cache
        //karena jika tidak config yang banyak akan memperlambat
        //aplikasi, kita bisa gunakan php artisan config:cache dan
        //akan di simpan di folder cache config.php

        //jika ada perubahan pada config kita, kita perlu
        //caching ulang dengan php artisan config:clear
        //lalu jalankan ulang command diatas
    }
}
