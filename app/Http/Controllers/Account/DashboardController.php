<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Implements user dashboard page.
 */
class DashboardController extends Controller
{
    /**
     * Display user dashboard page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     *   Return view template.
     */
    public function __invoke()
    {
        return view('front.account.dashboard');
    }
}
