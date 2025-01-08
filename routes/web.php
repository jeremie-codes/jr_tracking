<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/404', '404')->name('404');
Route::view('/about-us', 'about-us')->name('about');
Route::view('/blog-details', 'blog-details')->name('blog_details');
Route::view('/blog-grid', 'blog-grid')->name('blog_grid');
Route::view('/blog', 'blog')->name('blog');
Route::view('/cart', 'cart')->name('cart');
Route::view('/checkout', 'checkout')->name('checkout');
Route::view('/coming-soon', 'coming-soon')->name('coming_soon');
Route::view('/contact', 'contact')->name('contact');
Route::view('/forgot-password', 'forgot-password')->name('forgot_password');
Route::view('/my-account', 'my-account')->name('my_account');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy_policy');
Route::view('/reset-password', 'reset-password')->name('reset_password');
Route::view('/shop', 'shop')->name('shop');
Route::view('/sign-in', 'sign-in')->name('sign_in');
Route::view('/sign-up', 'sign-up')->name('sign_up');
Route::view('/terms-of-service', 'terms-of-service')->name('terms_of_service');
