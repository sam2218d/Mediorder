<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException; // 1. Import the ValidationException

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
        // 2. Wrap the authentication attempt in a try-catch block
        try {
            $request->authenticate();
        } catch (ValidationException $e) {
            // 3. Redirect to the register page if authentication fails
            return redirect()->route('register')
                             ->with('error', 'Credentials do not match our records. Please create an account.');
        }

        $request->session()->regenerate();
        
        if (Auth::user()->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }
        
        if (Auth::user()->role === 'user') {
            return redirect('/');
        }

        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}