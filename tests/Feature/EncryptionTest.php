<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    //laravel sudah menyediakan fitur enkripsi dan dekripsi secara otomatis, untuk melakukan enkripsi dan deckripsi kita membuthkan key
    //yang disimpan di config/app.php, secara default laravel akan otomatis mengambil key yang ada di .env APP_KEY, key ini harus nya
    //diubah2 secara berkala, kita bisa auto generate key dengan command php artisan key:generate, unutk melakukan dekrip dan enkrip 
    //kita bisa gunakan Facade Crypt https://laravel.com/api/9.x/Illuminate/Support/Facades/Crypt.html
    public function testEncrypt()
    {
        $encrypt = Crypt::encrypt("Mazaro Yusuf");
        $decrypt = Crypt::decrypt($encrypt);

        self::assertEquals("Mazaro Yusuf", $decrypt);
    }
}
