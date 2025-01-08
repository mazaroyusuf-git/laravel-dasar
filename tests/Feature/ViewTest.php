<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get("/hello")
            ->assertSeeText("Hello yusuf");

        $this->get("/hello-again")
            ->assertSeeText("Hello yusuf");
    }

    public function testViewNested()
    {
        $this->get("/hello-world")
            ->assertSeeText("World yusuf");
    }

    //kita bisa melakukan test View tanpa sebuah routing dengan cara menggunakan
    //method view langsung di dalam test

    public function testViewWithoutRoute()
    {
        $this->view("hello", ["name" => "yusuf"])
            ->assertSeeText("Hello yusuf");
    }
}
