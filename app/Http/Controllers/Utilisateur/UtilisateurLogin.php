<?php

namespace App\Http\Controllers\utilisateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtilisateurLogin extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Vérifier d'abord les identifiants
        if (Auth::guard('utilisateur')->validate($credentials)) {
            $user = \App\Models\utilisateur::where('email', $credentials['email'])->first();

            if ($user) {
                // Vérifier si le compte est actif
                if (!$user->is_active) {
                    return back()->withErrors([
                        'email' => 'Votre compte est désactivé. Veuillez contacter l\'administrateur.'
                    ])->onlyInput('email');
                }

                // Si la double authentification (2FA) est activée pour cet utilisateur
                if ($user->two_factor_enabled) {
                    $remember = $request->has('remember');

                    // Stocker l'ID de l'utilisateur, remember et le guard dans la session invité
                    $request->session()->put('login.id', $user->id);
                    $request->session()->put('login.remember', $remember);
                    $request->session()->put('login.guard', 'utilisateur');

                    try {
                        // Générer le code et envoyer l'e-mail
                        $code = $user->generateTwoFactorCode();
                        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\TwoFactorCodeMail($code));
                    } catch (\Exception $e) {
                        return back()->withErrors([
                            'email' => 'Impossible d\'envoyer le code de vérification : ' . $e->getMessage()
                        ])->onlyInput('email');
                    }

                    // Rediriger vers la saisie du code 2FA
                    return redirect()->route('verify.index');
                }

                // Si 2FA n'est pas activée, connecter normalement
                if (Auth::guard('utilisateur')->attempt($credentials, $request->has('remember'))) {
                    $request->session()->regenerate();
                    return redirect()->intended('/utilisateur');
                }
            }
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('utilisateur')->logout();
        $request->session()->forget('utilisateur');
        $request->session()->regenerateToken();
        return redirect('/utilisateur');
    }
    public function index(){
        if (Auth::guard('utilisateur')->check()) {
            return redirect('/utilisateur');
        }
        return view("Utilisateur.utilisateur-login");
    }
}
