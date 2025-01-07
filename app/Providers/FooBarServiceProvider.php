<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    //secara default semua provider akan di load meskipun sedang tidak digunakan
    //kita bisa memberitahu laravel agar Provider tidak akan diload saat tidak 
    //sedang dipakai, dengan implemnets DeferrableProvider lalu gunakan method
    //provides() lalu isi dengan Dependency nya
    public function provides()
    {
        return[HelloService::class, Foo::class, Bar::class];
        //setelah itu kita lakukan di console php artisan clear-compiled lalu
        //php artisan config:cache
    }

    //best practice melakukan dependency injection adalah melakukannya
    //dengan ServiceProvider atau DependenctProvider, kita bisa 
    //membuat ServiceProvider dengan php artisan make:provider namaProvider
    //didalam ServiceProvider ada 2 method register dan boot

    //kita bisa melakukan hal simple ketika ingin bind atau singleton terhadap
    //interface ke class dengan cara 
    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];
    //ini hanya bisa untuk yang simple saja, bila kompleks kita lakukan seperti pada
    //register()

    //register() digunakan unutk meregistrasikan dependency ke ServiceContainer
    public function register()
    {
        //cara registrasi nya sama dengan saat memasukka object ke 
        //ServiceContainer di test
        $this->app->singleton(Foo::class, function () {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });
        //setelah membuat dependency kita perlu beritahu laravel ke config agar bisa 
        //di load oleh laravel
    }

    //boot() akan dipanggil setelah register() selesai
    public function boot()
    {

    }
}
