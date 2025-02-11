<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Controllers\Web\PaiementController;
use App\Http\Controllers\Web\ShopController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/order/cancel', [PaiementController::class, 'handleCanceled'])->name('cancel');
Route::get('/order/approve', [PaiementController::class, 'handleApproved'])->name('approve');
Route::get('/order/failed', [PaiementController::class, 'handlefailed'])->name('failed');

Route::get('/articles', [ProductController::class, 'index'])->name('articles');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('show_shop');
Route::get('/detail-product/{slug}', [ProductController::class, 'show'])->name('detail_product');
Route::post('/products/filter', [ProductController::class, 'filterProducts'])->name('products.filter');

// Les routes de gestion du panier
Route::get('cart', [CartController::class, 'show'])->name('cart');
Route::post('cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('cart/empty', [CartController::class, 'empty'])->name('cart.empty');
Route::put('/cart/update-multiple', [CartController::class, 'updateMultiple'])->name('cart.update.multiple');

Route::get('/orders', [OrderController::class, 'index'])->name('orders');

Route::view('/about-us', 'about-us')->name('about');
Route::view('/blog-details', 'blog-details')->name('blog_details');
Route::view('/blog-grid', 'blog-grid')->name('blog_grid');
Route::view('/blog', 'blog')->name('blog');
Route::view('/coming-soon', 'coming-soon')->name('coming_soon');
Route::view('/contact', 'contact')->name('contact');
Route::view('/forgot-password', 'forgot-password')->name('forgot_password');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy_policy');
Route::view('/reset-password', 'reset-password')->name('reset_password');
Route::view('/terms-of-service', 'terms-of-service')->name('terms_of_service');

Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::get('/register', [AuthController::class, 'registerView'])->name('register');

Route::post('/login', [AuthController::class, 'handleLogin'])->name('login');
Route::post('/register', [AuthController::class, 'handleRegister'])->name('register');
Route::post('/update/{id}', [AuthController::class, 'update'])->name('update');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/my-account', [AccountController::class, 'index'])->name('my_account');
    Route::get('/create-product', [ProductController::class, 'create'])->name('create_product');
    Route::get('/edit-product/{slug}', [ProductController::class, 'edit'])->name('update_product');
    Route::put('/edit-product/{id}', [ProductController::class, 'update'])->name('update_product');
    Route::get('/delete-product/{slug}', [ProductController::class, 'destroy'])->name('delete_product');
    Route::post('/create-product', [ProductController::class, 'store'])->name('create_product');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/Order/payment', [PaiementController::class, 'payorder'])->name('order.pay');
});

