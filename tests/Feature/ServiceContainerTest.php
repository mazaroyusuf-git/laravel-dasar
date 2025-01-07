<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Foo;
use App\Data\Bar;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;

class ServiceContainerTest extends TestCase
{
    //laravel punya fitur yang memudahkan Dependency Injection
    //bernama Service Container yang berguna sebagai manajement
    //Dependency yang berada pada class Application
    //https://laravel.com/api/9.x/Illuminate/Foundation/Application.html 
    //field $app adalah instance dari Application

    //kita bisa menggunakan method make(nama::class) unutk membuat
    //Dependency secara otomatis, object akan selalu dibuat baru
    //jadi harus hati2

    public function testCreateDependency()
    {
        $foo = $this->app->make(Foo::class); //new Foo()
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals("Foo", $foo->foo());
        self::assertEquals("Foo", $foo2->foo());
        self::assertNotSame($foo, $foo2);
    }

    //untuk membuat object yang membutuhkan parameter misal nya, construktor
    //yang membutuhkan parameter kita bisa gunakan method bind(key, closure)
    //kita perlu membuat return value pada closure yang mereturn kan new Class
    //dengan parameter yang dibutuhkan

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person("Yusuf", "Azam");
        });

        //setelah kita membuat bind dengan closure nya ketika kita menggunakan
        //method make method bind yang diatas akan dipanggil closure nya

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertSame("Yusuf", $person1->firstname);
        self::assertSame("Yusuf", $person2->firstname);
        self::assertNotSame($person1, $person2);
    }

    //ada kasus dimana kita tidak mau membuat object yang baru dan mau
    //menggunakan object yang sama, kita bisa menggunakan 
    //method singleton(key, closure)

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Yusuf", "Azam");
        });

        //setelah kita membuat singleton dengan closure nya ketika kita menggunakan
        //method make method singleton yang diatas akan dipanggil closure nya

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertSame("Yusuf", $person1->firstname);
        self::assertSame("Yusuf", $person2->firstname);
        self::assertSame($person1, $person2); //object sama
    }

    //jika kita ingin menggunakan object yang sudah ada kita bisa menggunakan
    //method instance(::class, objectnya)

    public function testInstance()
    {
        $person = new Person("Yusuf", "Azam");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertSame("Yusuf", $person1->firstname);
        self::assertSame("Yusuf", $person2->firstname);
        self::assertSame($person, $person1);
        self::assertSame($person2, $person1);
    }

    //ketika kita membuat class yang membutuhkan object lain maka otomatis
    //laravel akan mencari object tersebut syarat nya object dependency 
    //tersebut juga harus di buat dengan ServiceContainer

    public function testAutoInject()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);

        //object bar perlu object foo, maka laravel akan otomatis mencari nya
        //didalam Application

        $bar = $this->app->make(Bar::class);

        self::assertEquals("Foo and Bar", $bar->bar());
        self::assertSame($foo, $bar->foo);
    }

    //ada baik nya ketika kita membuat object yang berhubungan dengan logic
    //aplikasi kita akan membuat dulu interface logic nya lalu di implement
    //di class lain, kita bisa melakukan binding dengan cara seperti diatas
    //dengan method bind(interface, class) atau singleton(interface, class)
    //hal ini akan membuat interface nya bisa diakses sama seperti class
    //cara ini bisa juga dengan closure

    public function testHelloService()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);
        self::assertEquals("Halo Yusuf", $helloService->hello("Yusuf"));
    }
}
