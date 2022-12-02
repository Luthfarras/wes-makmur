<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;

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

Route::middleware(['auth'])->group(function () {
    Route::resource('kategori', KategoriController::class);
    Route::resource('post', PostController::class);
    Route::resource('produk', ProdukController::class);
    
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('akses/{post}', [PostController::class, 'atur']);
    Route::get('aksespro/{produk}', [ProdukController::class, 'atur']);
    Route::resource('user', UserController::class);
});

Auth::routes();

Route::resource('jamu', RecController::class);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('detail/{post}', [HomeController::class, 'show']);
