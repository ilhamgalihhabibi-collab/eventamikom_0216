<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;

// =========================================================================
// RUTE PUBLIK (LANDING PAGE & KATEGORI)
// =========================================================================

// Route untuk Halaman Utama Publik Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// TAMBAHAN DISINI: Menyediakan route detail kategori publik yang dipanggil di app.blade.php baris 58
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.show');


// =========================================================================
// RUTE AUTENTIKASI & BACKEND ADMIN
// =========================================================================

// Pengalihan otomatis dari /login ke /admin/login
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Grouping untuk URL yang berawalan /admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    // --------------------------------------------------
    // Rute Tamu (Bisa diakses sebelum login)
    // --------------------------------------------------
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --------------------------------------------------
    // Rute Terproteksi (Hanya bisa diakses jika sudah login & admin)
    // --------------------------------------------------
    Route::group(['middleware' => ['auth', 'admin']], function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Resource routes untuk manajemen data
        Route::resource('events', EventController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('partners', PartnerController::class);
        
        // Rute langsung memanggil view admin.transactions
        Route::get('/transactions', function () {
            return view('admin.transactions');
        })->name('transactions');
    });
});