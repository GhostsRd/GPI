<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\utilisateur;

class UtilisateurLogin extends Component
{



    public function verifierlogin(Request $request,utilisateur $user){
        
    }
    public function render()
    {
        return view('livewire.utilisateur.utilisateur-login');
    }

}
