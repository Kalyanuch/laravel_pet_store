<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Category as ModelCategory;

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
        $category = ModelCategory::where('slug', '=', $slug)
            ->where('status', '=', '1')
            ->first();

        if (!$category) {
            abort(404);
        }

        $child = ModelCategory::where('parent_id', '=', $category->id)
            ->where('status', '=', '1')
            ->orderBy('sort_order', 'ASC')
            ->get();

        $products = $category->products()
            ->where('status', '=', '1')
            ->orderBy('sort_order', 'ASC')
            ->paginate(8);

        return view('front.catalog.category', compact('category', 'child', 'products'));
    }
}
