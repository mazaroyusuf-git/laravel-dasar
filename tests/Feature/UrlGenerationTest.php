<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlGenerationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCurrent()
    {
        $this->get("/url/current?name=yusuf")->assertSeeText("/url/current?name=yusuf");
    }

    public function testNamed()
    {
        $this->get("/url/named")->assertSeeText("/redirect/name/yusuf");
    }

    public function testAction()
    {
        $this->get("/url/action")->assertSeeText("/form");
    }
}
