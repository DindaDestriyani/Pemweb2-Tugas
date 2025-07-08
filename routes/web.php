<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController; 
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CartController;




//kode baru diubah menjadi seperti ini
Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('products', [HomepageController::class, 'products']);
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('product/{slug}', [HomepageController::class, 'product']);
Route::get('categories',[HomepageController::class, 'categories']);
Route::get('category/{slug}', [HomepageController::class, 'category']);
Route::get('cart', [HomepageController::class, 'cart']);
Route::get('checkout', [HomepageController::class, 'checkout']);

Route::get('cart', [HomepageController::class, 'cart'])->name('cart.index');
Route::get('checkout', [HomepageController::class, 'checkout'])->name('checkout.index');

Route::group(['middleware'=>['is_customer_login']], function(){
Route::controller(CartController::class)->group(function () {
Route::post('cart/add', 'add')->name('cart.add');
Route::delete('cart/remove/{id}', 'remove')->name('cart.remove');
Route::patch('cart/update/{id}', 'update')->name('cart.update');
});


// Route::get('/',[HomepageController::class,'index'])->name('home');

// Route::get('products', [HomepageController::class, 'products']);
    
// Route::get('/', function(){
//     return view('web.homepage');
// });
// Route::get('products', function(){
//     return view('web.products');
// });

// Route::get('product/{slug}', function($slug){
//     return "halaman single product - ".$slug;
// });
// Route::get('categories', function(){
//     return view('web.categories');
// });
// Route::get('category/{slug}', function($slug){
//     return "halaman single category - ".$slug;
// });
// Route::get('cart', function(){
//     return "halaman cart";
// });
// Route::get('checkout', function(){
//     return "halaman checkout";
// });

// Route::get('/beranda', function(){
//     return 'Welcome to E-Commerce';
// });

// Route::get('/daftar-produk', function(){
//     return 'Daftar semua produk';
// });

// Route::get('/detail-belanja', function(){
//     return 'Detail belanja';
// });

// Route::get('/keranjang', function(){
//     return 'Keranjang belanja pengguna';
// });

// Route::get('/cart', function(){
//     return 'Menambahkan produk ke keranjang belanja';
// });

// Route::get('/pembayaran', function(){
//     return 'Halaman pembayaran';
// });

// Route::get('/checkout', function(){
//     return 'Checkout berhasil';
// });

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// //Membuat prefix url untuk admin, dengan prefix dasboard
// Route::group(['prefix'=>'dashboard'], function(){
//     Route::get('/',[DashboardController::class,'index'])->name('dashboard');
// })->middleware(['auth', 'verified']);

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
//     Volt::route('settings/password', 'settings.password')->name('settings.password');
//     Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
// });

Route::prefix('dashboard')->group(function () {
    Route::resource('products', ProductController::class);
});

//route untuk customer
Route::group(['prefix'=>'customer'], function(){
    //semua route yang ada di dalam sini, diakses dengan prefix/customer
    /**
     * Kita akan membuat route untuk
     * 1. Login (menampilkan halaman login)
     * 2. Register (menampilkan halaman logout)
     * 3. untuk aksi login
     * 4. untuk aksi register
     * 5. untuk aksi logout
     */
    
 Route::controller(CustomerAuthController::class)->group(function(){
 Route::group(['middleware'=>'check_customer_login'], function(){
 //tampilkan halaman login
 Route::get('login','login')->name('customer.login');
 //aksi login
 Route::post('login','store_login')->name('customer.store_login');
 //tampilkan halaman register
 Route::get('register','register')->name('customer.register');
 //aksi register
 Route::post('register','store_register')->name('customer.store_register');
 });
 //aksi logout
 Route::post('logout','logout')->name('customer.logout');
 });
Route::apiResource('/product-categories', ProductCategoryController::class)->only('index','store','show','update','destroy');
Route::apiResource('/products', ProductController::class)->only('index','store','show','update','destroy');


});

Route::group(['prefix'=>'dashboard', 'middleware'=>['auth','vertified']], function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');

    Route::resource('categories', ProductCategoryController::class);
    Route::resource('products', ProductController::class);

   })->middleware(['auth', 'verified']);


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile','settings.profile')->name('settings.profile');
    Volt::route('settings/password','settings.password')->name('settings.password');
    Volt::route('settings/appearance','settings.appearance')->name('settings.appearance');
   });
   

require __DIR__.'/auth.php';
});