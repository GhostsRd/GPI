<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use App\Models\utilisateur; 

class UtilisateurListe extends Component
{

    
    public function Visualiser($id){

        return redirect()->route("userprofile", ["id"=> $id]);
    }
    public function render()
    {

        return view('livewire.admin.profile.utilisateur-liste',[

            "utilisateurs" => utilisateur::paginate(10)
        ]);
    }
}
