<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileSystemTest extends TestCase
{
    //laravel mendukung abstraction untuk management file nya menggunakan FlySystem
    //dengan fitur ini kita bisa manage file akan disimpan dimana, https://github.com/thephpleague/flysystem 
    //konfigurasi fileSystem berada di file config/filesystems.php, lihat chapter 30 untuk penjelasan config nya

    //implementasi File Storage ini ada di sebuah interface,https://laravel.com/api/9.x/Illuminate/Contracts/Filesystem/Filesystem.html 
    //dan untuk mendapatkan storage nya kita bisa gunakan Facade Storage::disk(namaFileStorage), 
    //ttps://laravel.com/api/9.x/Illuminate/Support/Facades/Storage.html 

    public function testStorage()
    {
        $filesystem = Storage::disk("local");
        $filesystem->put("file.txt", "Put Your Content Here");

        //kita bisa mudah mendapatkan file nya dengan method get(nama file.type) di Storage
        self::assertEquals("Put Your Content Here", $filesystem->get("file.txt"));
    }

    //laravel punya fitur Storage Link yang berguna untuk membuat link dari /storage/app/public ke /public/storage
    //dengan ini file yang terdapat pada di File Storage bisa diakses ke web di public, kita bisa gunakan command
    //php artisan storage:link, nanti di public akan di buatkan shortcut storage menuju /storage/app/public

    public function testPublic()
    {
        //akan dibuatkan file.txt di path public seperti di config
        $filesystem = Storage::disk("public");
        $filesystem->put("file.txt", "Put Your Content Here");

        self::assertEquals("Put Your Content Here", $filesystem->get("file.txt"));
    }

    public function testUpload()
    {
        //pada saat unit testing file kita bisa membuat fake file dengan method fake() yang ada pada Illuminate\Http\UploadedFile
        $image = UploadedFile::fake()->image("gambar.jpg");

        $this->post("/file/upload", ["picture" => $image])->assertSeeText("OK : gambar.jpg");
    }
}
