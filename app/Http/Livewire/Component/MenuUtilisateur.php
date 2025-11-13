<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class MenuUtilisateur extends Component
{
      public function redicrectlink($vals){
        if($vals == 1){
        return redirect()->route('utilisateurService');

        }
        elseif($vals == 2){
            return redirect()->route('checkout');
        }
        elseif($vals == 3){
            return redirect()->route('utilisateur.incident');
        }
        elseif($vals == 4){
            return redirect()->route('mes.reservation');
        }
    }
    public function render()
    {
        return view('livewire.component.menu-utilisateur');
    }
}
