<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Category;

/**
 * Implements catalog category page.
 */
class CategoryController extends Controller
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
        $category = Category::isActive()
            ->where('slug', '=', $slug)
            ->first();

        if (!$category) {
            abort(404);
        }

        $child = Category::isActive()
            ->where('parent_id', '=', $category->id)
            ->orderBy('sort_order', 'ASC')
            ->get();

        $products = $category->products()
            ->isActive()
            ->orderBy('sort_order', 'ASC')
            ->paginate(8);

        return view('front.catalog.category', compact('category', 'child', 'products'));
    }
}
