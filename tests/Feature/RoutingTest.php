<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testBasicRouting()
    {
        //dibanding kita mengetes dengan cara menjalankan local server
        //berikut cara mengetes routing dengan unit test
        $this->get("/yusuf")
            ->assertStatus(200)
            ->assertSeeText("Hello Yusuf");
    }

    public function testRedirect()
    {
        $this->get("/akun")
            ->assertRedirect("/yusuf");
    }

    public function testFallback()
    {
        $this->get("/404")
            ->assertSeeText("404 Halaman tidak ada");
    }
}
