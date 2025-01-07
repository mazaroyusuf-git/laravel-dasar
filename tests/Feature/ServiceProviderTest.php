<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;

class ServiceProviderTest extends TestCase
{
    public function testServiceProvider()
    {
        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }

    public function testPropertySingleton()
    {
        $helloService = $this->app->make(HelloService::class);
        $helloService1 = $this->app->make(HelloService::class);
        self::assertEquals("Halo Yusuf", $helloService->hello("Yusuf"));
        self::assertSame($helloService, $helloService1);
    }
}
