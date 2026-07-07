<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\MidtransWebhookController;

Route::post('/midtrans/callback', [MidtransWebhookController::class, 'handle']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.show');
Route::get('/event/{id}', [HomeController::class, 'show'])->name('events.show');

Route::get('/checkout/{event}', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/payment/{transaction}', [CheckoutController::class, 'payment'])->name('checkout.payment');
// Menambahkan rute halaman sukses pembayaran (Menggunakan {transaction} agar konsisten dengan pola Anda)
Route::get('/checkout/success/{transaction}', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/checkout/download/{transaction}', [CheckoutController::class, 'download'])->name('checkout.download');

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['auth', 'admin']], function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('events', EventController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('partners', PartnerController::class);
        
        
        Route::get('/transactions/pdf', [TransactionController::class, 'downloadPDF'])->name('transactions.pdf');
        
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    });
});