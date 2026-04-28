<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class UtilisateurProfile extends Component
{
    use WithFileUploads;

    public $nom, $poste, $email, $telephone, $lieu_affectation, $adresse, $photo, $newPhoto;
    public $showEditModal = false;
    public $stats = [
        'checkout' => 0,
        'reservations' => 0,
        'tickets' => 0
    ];

    protected $rules = [
        'nom' => 'required|string|max:255',
        'poste' => 'nullable|string|max:255',
        'telephone' => 'nullable|string|max:20',
        'lieu_affectation' => 'nullable|string|max:255',
        'adresse' => 'nullable|string|max:255',
        'newPhoto' => 'nullable|image|max:1024', // 1MB Max
    ];

    public function mount()
    {
        $user = Auth::guard('utilisateur')->user();
        $this->nom = $user->nom;
        $this->poste = $user->poste;
        $this->email = $user->email;
        $this->telephone = $user->telephone;
        $this->lieu_affectation = $user->lieu_affectation;
        $this->adresse = $user->adresse;
        $this->photo = $user->photo;

        // Fetch Real Stats
        $this->stats['tickets'] = $user->tickets()->count();
        $this->stats['checkout'] = $user->checkouts()->count();
        $this->stats['reservations'] = $user->reservations()->count();
    }

    public function follow()
    {
        $this->emit('toast', [
            'type' => 'info',
            'title' => 'Suivi',
            'message' => 'Vous suivez maintenant cet utilisateur.'
        ]);
    }

    public function sendMessage()
    {
        $this->emit('toast', [
            'type' => 'info',
            'title' => 'Message',
            'message' => 'Fonctionnalité de messagerie en cours de développement.'
        ]);
    }

    public function toggleEditModal()
    {
        $this->showEditModal = !$this->showEditModal;
    }

    public function saveProfile()
    {
        $this->validate();
        $user = Auth::guard('utilisateur')->user();

        $data = [
            'nom' => $this->nom,
            'poste' => $this->poste,
            'telephone' => $this->telephone,
            'lieu_affectation' => $this->lieu_affectation,
            'adresse' => $this->adresse,
        ];

        if ($this->newPhoto) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = $this->newPhoto->store('photos_profil', 'public');
            $this->photo = $data['photo'];
        }

        $user->update($data);
        $this->showEditModal = false;
        $this->emit('toast', [
            'type' => 'success',
            'title' => 'Succès',
            'message' => 'Profil mis à jour avec succès.'
        ]);
    }

    public function render()
    {
        return view('livewire.utilisateur.utilisateur-profile');
    }
}
