<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product as ModelProduct;

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
        $product = ModelProduct::where('slug', '=', $slug)
            ->where('status', '=', '1')
            ->first();

        if (!$product) {
            abort(404);
        }

        return view('front.catalog.product', compact('product'));
    }
}
