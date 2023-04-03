<?php

use App\Http\Controllers\Account\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController,
    CategoryController,
    ProductController
};
use App\Http\Controllers\Front\{
    CartController,
    CheckoutController,
    CategoryController as CatalogCategoryController,
    ProductController as CatalogProductController
};
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

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/category/{slug}', [CatalogCategoryController::class, 'index'])->name('category');
    Route::get('/product/{slug}', [CatalogProductController::class, 'index'])->name('product');
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
