<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{

    public function testInput()
    {
        $this->get("/input/hello?name=Yusuf")->assertSeeText("Hello Yusuf");
        $this->post("/input/hello", ['name' => 'Yusuf'])->assertSeeText('Hello Yusuf');
    }

    public function testUnputNested()
    {
        //di postman kita bisa menggunakan nested nya dengan name[first]
        $this->post("input/hello/first", ["name" => ["first" => "Yusuf"]])->assertSeeText("Hello Yusuf");
    }

    public function testInputAll()
    {
        $this->post("/input/hello/input", ["name" => ["first" => "Mazaro", "last" => "Yusuf"]])->assertSeeText("name")->assertSeeText("first")
        ->assertSeeText("Mazaro")->assertSeeText("last")->assertSeeText("Yusuf");
    }

    public function testInputArray()
    {
        $this->post("/input/hello/input", ["products" => ["name" => "Apple Mac Book Pro"], ["name" => "Samsung Galaxy S"]])
            ->assertSeeText("Apple Mac Book Pro")->assertSeeText("Samsung Galaxy S");
    }

    public function testInputType()
    {
        $this->post("/input/type", [
            "name" => "Yusuf",
            "married" => "false",
            "birth_date" => "1945-08-17"
        ])->assertSeeText("Yusuf")->assertSeeText("false")->assertSeeText("1945-08-17");
    }

    public function testFilterOnly()
    {
        $this->post("/input/filter/only", [
            "name" => [
                "first" => "Mazaro",
                "middle" => "Franco",
                "last" => "Yusuf"
            ]
        ])->assertSeeText("Mazaro")->assertSeeText("Yusuf")->assertDontSeeText("Franco");
    }

    public function testFilterExcept()
    {
        $this->post("/input/filter/except", [
            "username" => "yusuf",
            "admin" => "true",
            "password" => "dekaja"
        ])->assertSeeText("username")->assertSeeText("password")->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post("/input/filter/merge", [
            "username" => "yusuf",
            "admin" => "true",
            "password" => "dekaja"
        ])->assertSeeText("username")->assertSeeText("password")->assertSeeText("admin")->assertSeeText("false");
    }
}
