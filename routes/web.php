<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\DashboardUserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'kontak'])->name('kontak');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/categories/{slug}', [HomeController::class, 'category'])->name('category');
Route::get('/product/{slug}', [HomeController::class, 'productDetail'])->name('product');

Route::get('midtrans/success', [HomeController::class, 'success'])->name('midtrans.success');
Route::get('midtrans/unfinish', [HomeController::class, 'unfinish'])->name('midtrans.unfinish');
Route::get('midtrans/error', [HomeController::class, 'error'])->name('midtrans.error');

Route::post('send-email', [HomeController::class, 'sendEmail'])->name('send-email');

Route::prefix('admin')
    ->middleware('isAdmin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('admin', AdminController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('users', UserController::class);
        Route::resource('products', ProductController::class);
        Route::post('/upload-gallery', [ProductController::class, 'productGalleryUpload'])->name('upload.gallery');
        Route::get('/product-gallery-delete/{id}', [ProductController::class, 'productGalleryDelete'])->name('product.gallery.delete');
        Route::resource('transactions', TransactionController::class);

        // setting akun
        Route::get('/setting', [AdminController::class, 'setting'])->name('setting.index');

        Route::put('/setting', [AdminController::class, 'settingUpdate'])->name('setting.update');
    });

Route::prefix('user')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardUserController::class, 'index'])->name('user.index');
        Route::get('/transactions', [DashboardUserController::class, 'transactions'])->name('transactions.user.index');
        Route::get('/transactions/{id}', [DashboardUserController::class, 'transaction'])->name('transaction');
        Route::get('/setting', [DashboardUserController::class, 'setting'])->name('setting.user.index');
        Route::put('/setting', [DashboardUserController::class, 'updateUser'])->name('user.setting.update');
        Route::put('/setting/alamat', [DashboardUserController::class, 'updateAlamatUser'])->name('user.setting.alamat');
        Route::get('/setting/alamat', [DashboardUserController::class, 'settingAlamat'])->name('setting.alamat');

        // Add To Cart
        Route::post('/cart/{id}', [CartController::class, 'addCart'])->name('addToCart');

        // checkout
        Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');


        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('delete-cart');
        Route::get('/province', [CartController::class, 'provinces'])->name('api-provinces');
        Route::get('/regencies/{id}', [CartController::class, 'regencies'])->name('api-regencies');
        Route::get('/district/{id}', [CartController::class, 'distric'])->name('api-district');
    });
Auth::routes();
