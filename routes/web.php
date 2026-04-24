<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

// Import Controller User
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;

// Import Controller Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ================= RUTE USER AREA =================

// 1. Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Detail Event (Dikembalikan ke /event-detail agar tidak error 404)
Route::get('/event-detail', [EventController::class, 'show'])->name('events.show');

// 3. Checkout
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');

// 4. Tiket (Diperbaiki menggunakan TicketController dan method index)
Route::get('/my-ticket', [TicketController::class, 'index'])->name('ticket');

// ================= RUTE ADMIN AREA =================
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    
    // PERBAIKAN DI SINI:
    Route::get('/transactions', function () {
        return view('admin.transactions'); // Gunakan view() dan tanda kutip
    })->name('transactions');
});