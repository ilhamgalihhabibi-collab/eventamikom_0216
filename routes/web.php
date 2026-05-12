<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController as AdminEventController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event-detail', [EventController::class, 'show'])->name('events.show');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/my-ticket', [TicketController::class, 'index'])->name('ticket');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', AdminEventController::class);
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/transactions', function () {
        return view('admin.transactions'); 
    })->name('transactions');
});