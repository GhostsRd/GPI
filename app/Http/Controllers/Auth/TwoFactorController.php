<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\TwoFactorCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TwoFactorController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Afficher le formulaire de saisie du code 2FA.
     */
    public function index()
    {
        if (!session()->has('login.id')) {
            return redirect()->route('login');
        }

        return view('auth.twoFactor');
    }

    /**
     * Valider le code 2FA saisi par l'utilisateur.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric|digits:6',
        ], [
            'code.required' => 'Le code de vérification est requis.',
            'code.numeric' => 'Le code doit être composé de chiffres.',
            'code.digits' => 'Le code doit comporter exactement 6 chiffres.',
        ]);

        if (!session()->has('login.id')) {
            return redirect()->route('login');
        }

        $userId = session('login.id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Utilisateur introuvable.']);
        }

        // Vérifier si le code est correct et s'il n'est pas expiré
        if ($user->two_factor_code !== $request->code) {
            return redirect()->back()
                ->withErrors(['code' => 'Le code de vérification est incorrect.'])
                ->withInput();
        }

        if (now()->gt($user->two_factor_expires_at)) {
            return redirect()->back()
                ->withErrors(['code' => 'Ce code de vérification a expiré. Veuillez en demander un nouveau.'])
                ->withInput();
        }

        // Tout est bon : réinitialiser le code 2FA et connecter l'utilisateur
        $user->resetTwoFactorCode();

        // Connexion formelle
        Auth::login($user, session('login.remember', false));

        // Nettoyer la session
        session()->forget(['login.id', 'login.remember']);

        return redirect()->intended(route('home'));
    }

    /**
     * Renvoyer un nouveau code 2FA.
     */
    public function resend()
    {
        if (!session()->has('login.id')) {
            return redirect()->route('login');
        }

        $userId = session('login.id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login');
        }

        // Générer et envoyer le nouveau code
        $code = $user->generateTwoFactorCode();
        Mail::to($user->email)->send(new TwoFactorCodeMail($code));

        return redirect()->back()->with('status', 'Un nouveau code de validation a été envoyé à votre adresse e-mail.');
    }
}
