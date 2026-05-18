<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        $email = request()->input('email');
        if ($email && \App\Models\utilisateur::where('email', $email)->exists()) {
            return \Illuminate\Support\Facades\Password::broker('utilisateurs');
        }
        return \Illuminate\Support\Facades\Password::broker('users');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        $email = request()->input('email');
        if ($email && \App\Models\utilisateur::where('email', $email)->exists()) {
            return \Illuminate\Support\Facades\Auth::guard('utilisateur');
        }
        return \Illuminate\Support\Facades\Auth::guard('web');
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @return string
     */
    public function redirectTo()
    {
        $email = request()->input('email');
        if ($email && \App\Models\utilisateur::where('email', $email)->exists()) {
            return '/utilisateur';
        }
        return RouteServiceProvider::HOME;
    }
}
