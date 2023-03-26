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
use App\Http\Controllers\Account\DashboardController as UserDashboard;

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

// Front routes group
Route::group(['as' => 'front.'], function () {
    Route::middleware(['auth'/*, 'verified'*/])->group(function () {
        Route::get('/dashboard', UserDashboard::class)->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/cart', [Cart::class, 'index'])->name('cart');
    Route::get('/checkout', [Checkout::class, 'index'])->name('checkout');
    Route::get('/category/{slug}', [Category::class, 'index'])->name('category');
    Route::get('/product/{slug}', [Product::class, 'index'])->name('product');
});

// Admin routes group
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('/categories', CategoryController::class);
        Route::resource('/products', ProductController::class);
    });
});

require __DIR__.'/auth.php';
