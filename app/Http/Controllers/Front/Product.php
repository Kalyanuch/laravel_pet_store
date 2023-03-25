<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Implements catalog product page.
 */
class Product extends Controller
{
    /**
     * Display product page.
     *
     * @param $slug
     *   Product slug.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index($slug)
    {
        return view('front.catalog.product');
    }
}
