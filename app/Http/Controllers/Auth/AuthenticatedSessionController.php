<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\View\View;
use App\Notifications\LoginNotification;


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
        $request->authenticate();
        $user = auth()->user();
        // Mail::send([], [], function ($message) use ($user) {
        //     $message->to($user->email)
        //             ->subject('Welcome to our platform')
        //             ->setBody('<h1>Thank you for registering with us!</h1>', 'text/html');
        // });
                Mail::raw('Thank you for login with us!', function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Welcome to our platform');
        });

        $request->session()->regenerate();

        return redirect()->intended(route('todos.index', absolute: false));
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
