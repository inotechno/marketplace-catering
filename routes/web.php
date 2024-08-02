<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\RegisterCustomer;
use App\Livewire\Auth\RegisterMerchant;
use App\Livewire\Catering\CateringIndex;
use App\Livewire\Catering\CateringProduct;
use App\Livewire\Dashboard\DashboardIndex;
use App\Livewire\Order\OrderIndex;
use App\Livewire\Product\ProductCreate;
use App\Livewire\Product\ProductEdit;
use App\Livewire\Product\ProductIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register-merchant', RegisterMerchant::class)->name('register.merchant')->middleware('guest');
Route::get('/register-customer', RegisterCustomer::class)->name('register.customer')->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', DashboardIndex::class);
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard.index');

    Route::group(['middleware' => 'role:Merchant'], function () {
        Route::get('/product', ProductIndex::class)->name('product.index');
        // Route::get('/product/{id}', ProductIndex::class)->name('product.edit');
        Route::get('/product/create', ProductCreate::class)->name('product.create');
        Route::get('/product/edit/{id}', ProductEdit::class)->name('product.edit');
    });

    Route::group(['middleware' => 'role:Customer'], function () {
        Route::get('/catering', CateringIndex::class)->name('catering.index');
        Route::get('/catering/{merchant_id}', CateringProduct::class)->name('catering.product');
    });

    Route::get('/order', OrderIndex::class)->name('order.index');
});
