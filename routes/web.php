<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

// ----------------- Auth -----------------
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');

Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman awal redirect ke login
Route::get('/', function () {
    return redirect('/login');
});

// ----------------- Protected Pages -----------------
Route::middleware(['auth', 'prevent.back'])->group(function () {

    Route::resource('siswa', SiswaController::class);
    Route::resource('user', UserController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/home', [ProdukController::class, 'index'])->name('home');
    
    // Route untuk produk diskon
    Route::get('/produk/diskon', [ProdukController::class, 'diskon'])->name('produk.diskon');
    
    // Admin-only produk routes (create, edit, update, delete)
    Route::middleware(['admin'])->group(function () {
        Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
        Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
        Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
        Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
        Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    });
    
    // Produk routes - semua user bisa lihat index dan show
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');

Route::get('/kelola-user', [UserController::class, 'index'])->name('user.index');
Route::get('/kelola-user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/kelola-user', [UserController::class, 'store'])->name('user.store');
Route::get('/kelola-user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/kelola-user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/kelola-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');



});
