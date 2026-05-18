<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCodeMail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // 1. Sauvegarder les infos nécessaires dans la session invité
        $userId = $user->id;
        $remember = $request->has('remember');

        // 2. Déconnecter l'utilisateur immédiatement
        $this->guard()->logout();

        // 3. Stocker en session
        $request->session()->put('login.id', $userId);
        $request->session()->put('login.remember', $remember);

        try {
            // 4. Générer le code et envoyer l'e-mail
            $code = $user->generateTwoFactorCode();
            Mail::to($user->email)->send(new TwoFactorCodeMail($code));
        } catch (\Exception $e) {
            // En cas d'erreur d'envoi d'e-mail, on affiche un message d'erreur
            return redirect()->route('login')->withErrors([
                'email' => 'Impossible d\'envoyer le code de vérification : ' . $e->getMessage()
            ]);
        }

        // 5. Rediriger vers la saisie du code 2FA
        return redirect()->route('verify.index');
    }
}
