<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\Cart;
use App\Http\Controllers\Front\Checkout;
use App\Http\Controllers\Front\Category;
use App\Http\Controllers\Front\Product;

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

Route::get('/', function () {
//    return view('welcome');
    return view('front.home');
})->name('front.homepage');

Route::get('/cart', [Cart::class, 'index'])->name('front.cart');
Route::get('/checkout', [Checkout::class, 'index'])->name('front.checkout');
Route::get('/category/{slug}', [Category::class, 'index'])->name('front.category');
Route::get('/product/{slug}', [Product::class, 'index'])->name('front.product');

// Admin routes group
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('/categories', CategoryController::class);
        Route::resource('/products', ProductController::class);
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
