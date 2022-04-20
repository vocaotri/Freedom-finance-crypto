<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
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

Route::controller(AuthController::class)->group(function () {
    Route::match(['get', 'post'], '/login', 'login')->name('login');
    Route::match(['get', 'post'], '/register', 'register')->name('register');
    Route::match(['get', 'post'], '/logout', 'logout')->name('logout');
});

Route::middleware('is_user')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::controller(CryptoController::class)->name('crypto.')->group(function () {
        Route::get('/crypto', 'index')->name('index');
        Route::match(['get','post'],'/crypto-add', 'add')->name('add');
        Route::match(['get', 'post'],'/crypto-edit/{id}', 'edit')->name('edit');
        Route::get('/crypto-delete/{id}', 'delete')->name('delete');
    });
    Route::controller(TransactionController::class)->name('transaction.')->group(function () {
        Route::get('/transaction/{cryptoID?}', 'index')->name('index');
        Route::match(['get','post'],'/transaction-add', 'add')->name('add');
        Route::match(['get', 'post'],'/transaction-edit/{id}', 'edit')->name('edit');
        Route::get('/transaction-delete/{id}', 'delete')->name('delete');
    });
});
