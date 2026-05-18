<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Settings extends Component
{
    // Profile information fields
    public $name;
    public $email;
    public $phone;
    public $poste;
    public $location;
    public $two_factor_enabled;

    // Password change fields
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    // Guard being used
    public $guard;

    public function mount()
    {
        // Detect which guard is logged in
        if (Auth::guard('utilisateur')->check()) {
            $this->guard = 'utilisateur';
            $user = Auth::guard('utilisateur')->user();
            $this->name = $user->nom;
            $this->email = $user->email;
            $this->phone = $user->telephone;
            $this->poste = $user->poste;
            $this->location = $user->lieu_affectation;
            $this->two_factor_enabled = (bool) $user->two_factor_enabled;
        } else {
            $this->guard = 'web';
            $user = Auth::guard('web')->user();
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->poste = $user->poste;
            $this->location = $user->lieu_travail;
            $this->two_factor_enabled = (bool) $user->two_factor_enabled;
        }
    }

    public function updateProfile()
    {
        $user = Auth::guard($this->guard)->user();

        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'poste' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ];

        // Ensure unique email among users
        if ($this->guard === 'utilisateur') {
            $rules['email'] = 'required|email|max:255|unique:utilisateurs,email,' . $user->id;
        } else {
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $user->id;
        }

        $this->validate($rules, [
            'name.required' => 'Le nom est requis.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
        ]);

        if ($this->guard === 'utilisateur') {
            $user->update([
                'nom' => $this->name,
                'email' => $this->email,
                'telephone' => $this->phone,
                'poste' => $this->poste,
                'lieu_affectation' => $this->location,
            ]);
        } else {
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'poste' => $this->poste,
                'lieu_travail' => $this->location,
            ]);
        }

        $this->emit('toast', [
            'type' => 'success',
            'title' => 'Profil mis à jour',
            'message' => 'Vos informations ont été enregistrées avec succès.'
        ]);
    }

    public function toggleTwoFactor()
    {
        $user = Auth::guard($this->guard)->user();
        
        $user->forceFill([
            'two_factor_enabled' => $this->two_factor_enabled
        ])->save();

        $statusMessage = $this->two_factor_enabled 
            ? 'La double authentification (2FA) a été activée sur votre compte.' 
            : 'La double authentification (2FA) a été désactivée.';

        $this->emit('toast', [
            'type' => 'success',
            'title' => 'Double Authentification',
            'message' => $statusMessage
        ]);
    }

    public function updatePassword()
    {
        $user = Auth::guard($this->guard)->user();

        $this->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::min(6)],
        ], [
            'current_password.required' => 'Votre mot de passe actuel est requis.',
            'new_password.required' => 'Un nouveau mot de passe est requis.',
            'new_password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'new_password.min' => 'Le nouveau mot de passe doit comporter au moins 6 caractères.',
        ]);

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Le mot de passe actuel est incorrect.');
            return;
        }

        $user->forceFill([
            'password' => Hash::make($this->new_password)
        ])->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        $this->emit('toast', [
            'type' => 'success',
            'title' => 'Mot de passe mis à jour',
            'message' => 'Votre mot de passe a été modifié avec succès.'
        ]);
    }

    public function render()
    {
        return view('livewire.settings');
    }
}
