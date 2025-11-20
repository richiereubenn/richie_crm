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
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (
            !Auth::attempt([
                'username' => $request->username,
                'password' => $request->password
            ], $request->boolean('remember'))
        ) {

            return back()->withErrors([
                'username' => 'Username atau password salah',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'Admin') {
            return redirect()->route('users.index');
        }

        if ($user->role === 'Manager') {
            return redirect()->route('projects.index');
        }

        if ($user->role === 'Sales') {
            return redirect()->route('leads.index');
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
