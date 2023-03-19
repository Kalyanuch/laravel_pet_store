<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

/**
 * Implements the admin dashboard functionality.
 */
class DashboardController extends Controller
{
    /**
     * Admin dashboard page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index() {
        // Test for slug generator
        $category = new Category();
        $category->title = 'Hello my world';
        $category->save();

        return view('admin.dashboard.index');
    }
}
