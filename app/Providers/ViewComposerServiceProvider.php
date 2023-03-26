<?php

namespace App\Providers;

use App\Http\ViewComposers\CategoriesMenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Implements service provider for view composers.
 */
class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('front.layout.layout', CategoriesMenuComposer::class);
    }
}
