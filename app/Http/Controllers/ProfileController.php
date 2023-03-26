<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

/**
 * Implements user profile management.
 */
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param Request $request
     *   Request service.
     *
     * @return View
     *   Return view template.
     */
    public function edit(Request $request): View
    {
        return view('front.account.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param ProfileUpdateRequest $request
     *   Request service.
     *
     * @return RedirectResponse
     *   Return redirect.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('front.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @param Request $request
     *   Request service.
     *
     * @return RedirectResponse
     *   Return redirect.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
