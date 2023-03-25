<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Implements catalog category page.
 */
class Category extends Controller
{
    /**
     * Display category page.
     *
     * @param $slug
     *   Product slug.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index($slug)
    {
        return view('front.catalog.category');
    }
}
