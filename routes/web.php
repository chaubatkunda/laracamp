<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', fn () => view('home'))->name('home');

// Sociallite Route
Route::get('/login-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('/auth/google/calback', [UserController::class, 'heandleProviderCallback'])->name('user.google.callback');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success')->middleware('ensureUserRole:user');
    Route::get('checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create')->middleware('ensureUserRole:user');
    Route::post('checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('ensureUserRole:user');
    Route::get('checkout/invoice/{checkout}', [CheckoutController::class, 'invoice'])->name('user.checkout.invoice')->middleware('ensureUserRole:user');

    // Route::resource('checkout', CheckoutController::class);
});

require __DIR__ . '/auth.php';
