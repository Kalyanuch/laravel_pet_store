<?php
// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

use App\Models\Product;
use App\Models\Category;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push(__('front.text_home'), route('front.homepage'));
});

// Login
Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('front.text_login'), route('login'));
});

// Register
Breadcrumbs::for('register', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('front.text_register'), route('register'));
});

// Forgot password
Breadcrumbs::for('forgot_password', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('front.account.text_forgot_password'), route('password.request'));
});

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('front.text_dashboard'), route('front.dashboard'));
});

// Profile
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(__('front.text_profile'), route('front.profile.edit'));
});

// Category
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, Category $category) {
    $trail->parent('home');

    if ($category->parent_id) {
        $parent = Category::find($category->parent_id);

        $trail->push($parent->title, route('front.category', ['slug' => $parent->slug]));
    }

    $trail->push($category->title, route('front.category', ['slug' => $category->slug]));
});

// Product
Breadcrumbs::for('product', function (BreadcrumbTrail $trail, Product $product) {
    $trail->parent('home');

    $categories = $product->categories->sortBy('category_id');

    foreach ($categories as $item) {
        $trail->push($item->title, route('front.category', ['slug' => $item->slug]));
    }

    $trail->push($product->title, route('front.product', ['slug' => $product->slug]));
});

// Admin
Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('admin.admin'), route('admin.dashboard.index'));
});

// Admin dashboard
Breadcrumbs::for('admin_dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(__('admin.dashboard.dashboard'), route('admin.dashboard.index'));
});

// Admin categories List
Breadcrumbs::for('admin_categories_list', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(__('admin.categories.list'), route('admin.categories.index'));
});

// Admin category add
Breadcrumbs::for('admin_category_add', function (BreadcrumbTrail $trail) {
    $trail->parent('admin_categories_list');
    $trail->push(__('admin.categories.add_new'), route('admin.categories.create'));
});

// Admin category edit
Breadcrumbs::for('admin_category_edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin_categories_list');
    $trail->push(__('admin.categories.edit'), route('admin.categories.edit'));
});

// Admin products List
Breadcrumbs::for('admin_products_list', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(__('admin.products.list'), route('admin.products.index'));
});

// Admin product add
Breadcrumbs::for('admin_product_add', function (BreadcrumbTrail $trail) {
    $trail->parent('admin_products_list');
    $trail->push(__('admin.products.add_new'), route('admin.products.create'));
});

// Admin product edit
Breadcrumbs::for('admin_product_edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin_products_list');
    $trail->push(__('admin.products.edit'), route('admin.products.edit', ['product' => '1']));
});
