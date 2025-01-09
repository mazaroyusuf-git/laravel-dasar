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

    public function testRoutingParameter()
    {
        $this->get("/products/1")
            ->assertSeeText("Products : 1");

        $this->get("/products/1/items/1")
            ->assertSeeText("Products : 1, Items : 1");
    }

    public function testRouteParameterRegex()
    {
        $this->get("/categories/12345")->assertSeeText("Categories : 12345");
        $this->get("/categories/salah")->assertSeeText("404");
    }

    public function testRouteOprionalParam()
    {
        $this->get("/users/1234")->assertSeeText("Users : 1234");
        $this->get("/users/")->assertSeeText("Users : 404");
    }

    public function testNamedRouting()
    {
        $this->get("/produk/1234")->assertSeeText("products/1234");
        $this->get("/produk-redirect/1234")->assertRedirect("products/1234");
    }
}
