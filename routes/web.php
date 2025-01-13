<?php

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| baca ini
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
| kita bisa menggunakan Facades Route dan menggunakan method berikut untuk routing 
| applikasi kita, contoh Route::get($url, $callback atau closure yang akan dipanggil
| ketika route ini digunakan ada banyak post(), put(), patch(), delete(), options()
)
*/


//contoh membuat Route::get
Route::get('/', function () {
    return view('welcome');
});

Route::get("/yusuf", function () {
    return "Hello Yusuf";
});

//Routing juga bisa redirect, dengan cara Route::redirect(url, tujuan)
//ketika mengakses /akun akan langsung redirect ke /yusuf
Route::redirect("/akun", "/yusuf");


//kita bisa melihat semua routing kita dengan command php artisan route:list

//ketika kita ingin mengakses route yang tidak ada otomatis kita akan dapat kode 
//404, kita bisa modifikasi halaman 404 dengan static method fallback

Route::fallback(function () {
    return "404 Halaman tidak ada";
});

//setelah kita membuat template view di ../resources/views kita perlu membuat render
//nya, dengan static method view atau dengan get juga bisa yang didalam nya ada method
//view

//Route::view($url, template, array data atau model nya yang akan dikirm ke var di template)
Route::view("/hello", "hello", ["name" => "yusuf"]);

//dengan get($url, closure atau callback)
Route::get("/hello-again", function () {
    //jika pakai method http kita tidak perlu lagi memasukkan url nya di method view
    return view("hello", ["name" => "yusuf"]);
});

//ketika kita ingin mengakses template yang berada di folder lain dalam views
//dibandingkan kita menggunakan \ kita gunakan .
Route::get("/hello-world", function () {
    return view("hello.world", ["name" => "yusuf"]);
});

//ketika kita melakuka request secara tiba2 saat di production otomatis template
//view akan di compile dan memakan proses lama jika template banyak, ada baik nya kita
//melakukan compile dari awal sebelum aplikasi nyala agar tidak menggangu performa
//saat live, kita bisa gunakan command php artisan view:cache dan unutk menghapus
//php artisan view:clear

//kita bisa memasukkan data ke parameter yang ada pada url dengan menggunakan {data}
//nanti data yang ada di paramater url tersebut kita kirimkan datanya lewat closure
//atau callback function nya

//kita bisa menambahkan nama para Routing yang kita buat agar memudahkan kita
//ketika kita ingin mendapatkan info routing tersebut

Route::get("/products/{id}", function ($productId) {
    return "Products : " . $productId;
})->name("product.detail");
//{id} dan $productId saling terhubung

Route::get("/products/{products}/items/{item}", function ($productId, $itemId) {
    return "Products : " . $productId . ", Items : " . $itemId;
})->name("product.item.detail");
//{products} terhubung dengan $productId dan {item} terhubung dengan $itemId

//setelah pembuatan Routing kita bisa menambahkan ->where(param, [regex])
//yang berguna untuk memspesify data dari parameter nya harus apa
Route::get("/categories/{id}", function (string $categoryId) {
    return "Categories : " . $categoryId;
})->where("id", "[0-9]+")->name("category.detail");
//artinya id cuma bisa integer

//kita bisa membuat parameter optional dengan menambahkan tanda ? sesudah paramnya
//namun kita perlu menambahkan default value pada parameter closure nya
Route::get("/users/{id?}", function (string $userId = "404") {
    return "Users : " . $userId;
})->name("user.detail");

//begini cara mengambil info Routing, kita cukup gunakan name nya saja
//dengan method route
Route::get("/produk/{id}", function ($id) {
    $link = route("product.detail", [
        "id" => $id
    ]);
    return "Link : " . $link;
});

Route::get("/produk-redirect/{id}", function ($id) {
    return redirect()->route("product.detail", [
        "id" => $id
    ]);
});

//untuk menggunakan logic yang ada di controller kita bisa langsung menggunakan
//path nya lalu diikuti dengan nama function nya
Route::get("/controller/hello/request", 
    [\App\Http\Controllers\HelloController::class, "request"]);
    
Route::get("/controller/hello/{name}", 
    [\App\Http\Controllers\HelloController::class, "hello"]);

Route::get("/input/hello", [\App\Http\Controllers\InputController::class, "hello"]);

Route::post("/input/hello", [\App\Http\Controllers\InputController::class, "hello"]);

Route::post("/input/hello/first", [\App\Http\Controllers\InputController::class, "helloFirst"]);

Route::post("/input/hello/input", [\App\Http\Controllers\InputController::class, "helloInput"]);

Route::post("/input/hello/array", [\App\Http\Controllers\InputController::class, "arrayInput"]);

Route::post("/input/type", [\App\Http\Controllers\InputController::class, "inputType"]);

Route::post("/input/filter/only", [\App\Http\Controllers\InputController::class, "filterOnly"]);

Route::post("/input/filter/except", [\App\Http\Controllers\InputController::class, "filterExcept"]);

Route::post("/input/filter/merge", [\App\Http\Controllers\InputController::class, "filterMerge"]);

Route::post("/file/upload", [\App\Http\Controllers\FileController::class, "upload"])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::get("/response/hello", [\App\Http\Controllers\ResponseController::class, "response"]);

Route::get("/response/header", [\App\Http\Controllers\ResponseController::class, "header"]);

//kita bisa melakukan Route grouping dengan prefix path yang awalan nya sama, kita bisa menggunakan
//Rout::prefix(prefixnya)->group(closure dengan path2 nya)
Route::prefix("/response/type")->group(function () {
    Route::get("/view", [\App\Http\Controllers\ResponseController::class, "responseView"]);
    Route::get("/json", [\App\Http\Controllers\ResponseController::class, "responseJson"]);
    Route::get("/file", [\App\Http\Controllers\ResponseController::class, "responseFile"]);
    Route::get("/download", [\App\Http\Controllers\ResponseController::class, "responseDownload"]);
});

//kita juga bisa grouping route dengan controller yang sama kita bisa gunakan method controller(pathController::class)->group(closure)
Route::controller(\App\Http\Controllers\CookieController::class)->group(function () {
    Route::get("/cookie/set", "createCookie");
    Route::get("/cookie/get", "getCookie");
    Route::get("/cookie/clear", "clearCookie");
});

Route::get("/redirect/from", [\App\Http\Controllers\RedirectController::class, "redirectFrom"]);
Route::get("/redirect/to", [\App\Http\Controllers\RedirectController::class, "redirectTo"]);

Route::get("/redirect/name", [\App\Http\Controllers\RedirectController::class, "redirectName"]);
Route::get("/redirect/name/{name}", [\App\Http\Controllers\RedirectController::class, "redirectHello"])->name("redirect-hello");

//UrlGenerator juga bisa digunakan untuk membuat link menuju named routes, kita bisa gunakan method route(name, param)
//atau URL::route(name, param) atau url()->route(name, param)
Route::get("/url/named", function () {
    return route("redirect-hello", ["name" => "yusuf"]);
});

Route::get("/redirect/action", [\App\Http\Controllers\RedirectController::class, "redirectAction"]);

Route::get("/redirect/away", [\App\Http\Controllers\RedirectController::class, "redirectAway"]);

//disini kita untuk pakai middleware gunakan method middleware([arrayPathMiddleware/pakai alias]), dan kita bisa melakukan
//grouping url dengan middleware yang sama, kita bisa gunakan method middleware([aliasMiddleware:param...])->group(closurePath)
Route::middleware(["sample:MYG,401"])->group(function () {
    Route::get("/middleware/param", function () {
        return "PARAM";
    });
});

Route::get("/middleware/api", function () {
    return "OK";
})->middleware(["contoh"]);

//kita juga bisa melakukan grouping dengan misal nya middleware,prefix,controller,dll cukup gunakan method->method->method
Route::middleware(["myg"])->prefix("/middleware")->group(function () {
    Route::get("/group", function () {
        return "GROUP";
    });
});

//kadang kita mau mengakses url saat ini, namun object Request tidak ada, kita bisa gunakan class
//Illuminate\Routing\UrlGenerator method url() atau kita bisa gunakan Facades \illuminate\Support\Facades\URL
//current() untuk mendapatkan url saat ini tanpa param atau full() url lengkap dengan param
Route::get("/url/current", function () {
    //return url()->current();
    return \Illuminate\Support\Facades\URL::full();
});

//UrlGeneration juga bisa berguna untuk membuat link menuju controller action, laravel otomatis akan mencari path
//yang sesuai dengan controller action tersebut, kita bisa menggunakan method action(controllerAction, Param) atau
//URL::action(controllerAction, Param) atau url()->action(controllerAction, Param)
Route::get("/url/action", function () {
    return action([\App\Http\Controllers\FormController::class, "form"], []);
});

Route::get("/form", [\App\Http\Controllers\FormController::class, "form"]);
Route::post("/form", [\App\Http\Controllers\FormController::class, "submitForm"]);





