<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate user
        $request->authenticate();

        // Regenerate session
        $request->session()->regenerate();

        // ✅ Check logged-in user's role
        $user = Auth::user();

        if ($user->role->name === 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($user->role->name === 'user') {
            return redirect('/user/dashboard');
        }

        // Optional fallback if role not matched
        abort(403, 'Unauthorized role.');
    }

    /**
     * Logout and destroy session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
