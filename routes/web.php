<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::group(['middleware'=>'guest'], function(){
    Route::view('/','login');
});
Route::post('/login',[App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');
Route::post('/logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');

Route::group(['middleware'=>'admin'], function() {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/register', [App\Http\Controllers\AdminController::class, 'register'])->name('register');
    Route::post('/register', [App\Http\Controllers\AdminController::class, 'registerNewUser'])->name('register');
});
Route::group(['middleware'=>'instruktur'], function() {
    Route::get('/instruktur', [App\Http\Controllers\InstrukturController::class, 'index'])->name('instruktur');    
});
Route::group(['middleware'=>'member'], function() {
    Route::get('/member', [App\Http\Controllers\MemberController::class, 'index'])->name('member');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
