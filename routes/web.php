<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecycleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TempCartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DetailTransactionController;
use App\Http\Controllers\ReportingController;
use App\Models\DetailTransaction;

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

    Route::controller(SettingController::class)->group(function () {
        Route::get('settings', 'index');
        Route::post('settings/{id}/profile', 'profile_update');
        Route::post('settings/check_password', 'check_password');
        Route::post('settings/password', 'password_update');
    });

    Route::group(['middleware' => ['cekUserLogin:administrator']], function () {
        Route::resource('product', ProductController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('customer', CustomerController::class);
        Route::resource('cashier', CashierController::class);
        Route::resource('kitchen', KitchenController::class);
        Route::resource('recycle', RecycleController::class);
        Route::resource('archive', ArchiveController::class);
        
        Route::controller(ServiceController::class)->group(function () {
            Route::get('service/tax', 'tax_index');
            Route::put('service/tax/{tax}', 'tax_update');
            Route::post('service/tax/store', 'tax_store');
        });

        Route::controller(ReportingController::class)->group(function () {
            Route::get('reporting/sales', 'sales_index');
            Route::get('reporting/performance', 'performance_index');
            Route::get('reporting/tax', 'sales_tax');
        });
    });

    Route::group(['middleware' => ['cekUserLogin:cashier']], function () {
        Route::resource('transaction', TransactionController::class);

        Route::controller(InvoiceController::class)->group(function () {
            Route::get('invoice', 'index');
            Route::get('invoice/{transaction}/read', 'read');
            Route::get('invoice/download/{transaction}', 'download');
            Route::get('invoice/print/{transaction}', 'print');
        });

        Route::controller(TempCartController::class)->group(function () {
            Route::get('cart', 'index');
            Route::get('cart/read', 'read');
            Route::post('cart/{product}/store', 'store');
            Route::put('cart/update', 'update');
            Route::delete('cart/{id}', 'destroy');
        });

        Route::controller(ProductController::class)->group(function () {
            Route::get('menu', 'index');
            Route::post('product/search', 'search');
            Route::get('product/search/results', 'results');
        });
    });

    Route::group(['middleware' => ['cekUserLogin:kitchen']], function () {
        Route::controller(DetailTransactionController::class)->group(function () {
            Route::get('order', 'index');
            Route::get('order/read', 'read');
            Route::post('order/status/{id}', 'update');
            Route::get('order/details/{id}', 'show');
        });
    });

    Route::get('/dataProduct', [ProductController::class, 'dataProduct'])->name('dataProduct');
    Route::get('/dataCategory', [CategoryController::class, 'dataCategory'])->name('dataCategory');
    Route::get('/dataCustomer', [CustomerController::class, 'dataCustomer'])->name('dataCustomer');
    Route::get('/dataCashier', [CashierController::class, 'dataCashier'])->name('dataCashier');
    Route::get('/dataKitchen', [KitchenController::class, 'dataKitchen'])->name('dataKitchen');
    Route::get('/dataTax', [ServiceController::class, 'dataTax'])->name('dataTax');
    Route::get('/dataInvoice', [InvoiceController::class, 'dataInvoice'])->name('dataInvoice');
});