<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required', 'string'],
        ]);
        $this->ensureIsNotRateLimited($request);

        /*         if (! Auth::attempt(
            ['email' => $credentials['email'], 'password' => $credentials['password']],
            $request->boolean('remember')
        )) {
            RateLimiter::hit($this->throttleKey($request));

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        } */
        $login = $credentials['email'];
        $field = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'ci';

        if (! Auth::attempt(
            [
                $field => $login,
                'password' => $credentials['password'],
            ],
            $request->boolean('remember')
        )) {
            RateLimiter::hit($this->throttleKey($request));

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
        RateLimiter::clear($this->throttleKey($request));
        $request->session()->regenerate();
        return redirect()->route('home.index') /* ->intended('/settings/profile') */; 
    }

    protected function ensureIsNotRateLimited(Request $request)
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function forgotPassword()
    {
        return view('auth.forgotPassword');
    }
    public function resetPassword(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'string'],
        ]);
        Password::sendResetLink($request->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
        return redirect()->route('forgot.password');
    }
}
