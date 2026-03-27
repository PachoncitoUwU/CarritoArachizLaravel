<?php
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/consultar',function(){
    return view("aprendices");
});

Route::get('/insertar', function () {
 $user = new App\Models\User();
 $user->email = 'email@mail.com';
 $user->name = 'ejemplo';
 $user->password = 'mypassword';
 $user->save();
 return dd($user);
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/productos', [App\Http\Controllers\ProductController::class, 'index']);

Route::get('/checkout',function(){
    return view('checkout');
});

Route:: post("/checkout",[OrderController::class, "store"]);