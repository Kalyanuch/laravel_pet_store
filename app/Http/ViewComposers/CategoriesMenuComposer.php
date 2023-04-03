<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\View\View;

/**
 * Implements categories list composer.
 */
class CategoriesMenuComposer
{
    /**
     * Build categories list for menu.
     *
     * @param View $view
     *   View service.
     *
     * @return View
     *   View with data.
     */
    public function compose(View $view)
    {
        return $view->with('menu_categories', Category::rootCategories()
            ->IsActive()
            ->orderBy('sort_order', 'ASC')
            ->get());
    }
}
