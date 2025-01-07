<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Foo;
use App\Data\Bar;

class DependencyInjectionTest extends TestCase
{
    //begini contoh melakukan Dependency Injection
    //secara manual, kita bisa melakukan DI secara otomatis
    //dengan Service Container, lihat contoh nya di test
    //ServiceContainerTest
    public function testDIManual()
    {
        $foo = new Foo();
        $bar = new Bar($foo);

        self::assertEquals("Foo and Bar", $bar->bar());
    }
}
