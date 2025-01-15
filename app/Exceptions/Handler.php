<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     * kadang kita mau meng ignore exception tertentu misal exception saat terjadi validation error, kita bisa menggunakan
     * variable $dontReport dan masukkan ExceptionClass yang mau di ignore
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        ValidationException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     * 
     * saat terjadi exception kadang kita ingin mengirim error tersebut ke aplikasi lain seperti telegram, slack atau sentry
     * kita bisa menggunakan fitur laravel Error Reporter dimana kita bisa menambah logic ketika terjadi error, untuk melakukan
     * hal tersebut kita bisa gunakan method reportable yang ada pada method register pada App\Exception\Handler.php.
     * kita bisa manambahkan lebih dari satu error, kita bisa menghentikan error reporter selanjutnya dengan mereturnkan false
     * 
     * lalu ketika kita tidak ingin menampilkan atau render halaman error default bawaan laravel kita bisa gunakan
     * method rederable(function ($exception, ...) return)
     * 
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            var_dump($e);
        });

        $this->renderable(function (ValidationException $exception, Request $request) {
            return response("Bad Request", 400);
        }); 
    }
}
