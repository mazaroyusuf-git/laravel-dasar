<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateSession()
    {
        $this->get("/session/create")
            ->assertSeeText("OK")
            ->assertSessionHas("userId", "yusuf")
            ->assertSessionHas("isMember", "true");
    }

    public function testGetSession()
    {
        $this->withSession([
            "userId" => "yusuf",
            "isMember" => "true"
        ])->get("/session/get")
            ->assertSeeText("yusuf")->assertSeeText("true");
    }
}
