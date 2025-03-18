<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Halaman Utama
Route::get('/', 'HomeController@index')->name('home');

// Rute untuk Produk
Route::prefix('products')->group(function () {
    Route::get('/', 'ProductController@index')->name('products.index'); // Menampilkan semua produk
    Route::get('/{id}', 'ProductController@show')->name('products.show'); // Menampilkan detail produk
    Route::post('/', 'ProductController@store')->name('products.store'); // Menambahkan produk baru (admin)
    Route::put('/{id}', 'ProductController@update')->name('products.update'); // Memperbarui produk (admin)
    Route::delete('/{id}', 'ProductController@destroy')->name('products.destroy'); // Menghapus produk (admin)
});

// Rute untuk Keranjang Belanja
Route::prefix('cart')->group(function () {
    Route::get('/', 'CartController@index')->name('cart.index'); // Menampilkan keranjang belanja
    Route::post('/add/{productId}', 'CartController@add')->name('cart.add'); // Menambahkan produk ke keranjang
    Route::put('/update/{productId}', 'CartController@update')->name('cart.update'); // Memperbarui jumlah produk di keranjang
    Route::delete('/remove/{productId}', 'CartController@remove')->name('cart.remove'); // Menghapus produk dari keranjang
});

// Rute untuk Pemesanan
Route::prefix('checkout')->group(function () {
    Route::get('/', 'CheckoutController@index')->name('checkout.index'); // Menampilkan halaman checkout
    Route::post('/', 'CheckoutController@processOrder')->name('checkout.process'); // Memproses pesanan
});

// Rute untuk Akun Pengguna
Route::prefix('account')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('account.login'); // Halaman login
    Route::post('/login', 'Auth\LoginController@login')->name('account.login.submit'); // Proses login
    Route::post('/logout', 'Auth\LoginController@logout')->name('account.logout'); // Proses logout

    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('account.register'); // Halaman pendaftaran
    Route::post('/register', 'Auth\RegisterController@register')->name('account.register.submit'); // Proses pendaftaran

    Route::get('/profile', 'AccountController@profile')->name('account.profile'); // Halaman profil pengguna
});


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
