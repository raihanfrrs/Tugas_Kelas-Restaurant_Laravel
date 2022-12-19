<?php

use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DetailTransactionController;
use App\Http\Controllers\RecycleController;

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

Route::middleware('guest')->group(function () {
    Route::resource('login', LoginController::class);

    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'index')->name('login');
        Route::post('login', 'store');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'index')->name('register');
        Route::post('register', 'store');
    });
});

Route::middleware('auth')->group(function () {
    Route::controller(LayoutController::class)->group(function () {
        Route::get('/', 'index');
    });

    Route::controller(LogoutController::class)->group(function () {
        Route::get('logout', 'index')->name('logout');
    });

    Route::group(['middleware' => ['cekUserLogin:administrator']], function () {
        Route::resource('product', ProductController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('customer', CustomerController::class);
        Route::resource('cashier', CashierController::class);
        Route::resource('kitchen', KitchenController::class);
        Route::resource('recycle', RecycleController::class);
        Route::resource('archive', ArchiveController::class);
    });

    Route::group(['middleware' => ['cekUserLogin:cashier']], function () {
        Route::resource('transaction', TransactionController::class);
        Route::resource('item', DetailTransaction::class);
    });

    Route::group(['middleware' => ['cekUserLogin:kitchen']], function () {
        Route::resource('transaction', TransactionController::class);
        Route::resource('item', DetailTransactionController::class);
    });

    Route::get('/dataProduct', [ProductController::class, 'dataProduct'])->name('dataProduct');
    Route::get('/dataCategory', [CategoryController::class, 'dataCategory'])->name('dataCategory');
    Route::get('/dataCustomer', [CustomerController::class, 'dataCustomer'])->name('dataCustomer');
    Route::get('/dataCashier', [CashierController::class, 'dataCashier'])->name('dataCashier');
    Route::get('/dataKitchen', [KitchenController::class, 'dataKitchen'])->name('dataKitchen');
});