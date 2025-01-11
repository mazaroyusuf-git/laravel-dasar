<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testResponse()
    {
        $this->get("/response/hello")->assertStatus(200)->assertSeeText("Hello Response");
    }

    public function testHeader()
    {
        $this->get("/response/header")
            ->assertStatus(200)
            ->assertSeeText("Mazaro")
            ->assertSeeText("Yusuf")
            ->assertHeader("Content-Type", "application/json")
            ->assertHeader("Author", "Azam Yusuf")
            ->assertHeader("App", "Belajar laravel dasar");
    }

    public function testView()
    {
        $this->get("/response/type/view")->assertSeeText("Hello Yusuf");
    }

    public function testJson()
    {
        $this->get("/response/type/json")->assertJson([
            "firstname" => "Mazaro", "lastname" => "Yusuf"
        ]);
    }

    public function testFile()
    {
        $this->get("response/type/file")->assertHeader("Content-Type", "image/jpeg");
    }

    public function testDownload()
    {
        $this->get("response/type/download")->assertDownload("gambar.jpeg");
    }
}
