<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Implements user login-logout.
 */
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return View
     *   Return view template.
     */
    public function create(): View
    {
        return view('front.account.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest $request
     *   Request service.
     *
     * @return RedirectResponse
     *   Return redirect.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('front.dashboard');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     *   Request service.
     *
     * @return RedirectResponse
     *
     * Return redirect.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('front.homepage');
    }
}
