<?php

namespace App\Http\Livewire\Component;

use App\Models\Checkout;
use App\Models\checkoutreserver;
use App\Models\Incident;
use App\Models\ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MenuUtilisateur extends Component
{
    public function openReservationModal(){

            $this->dispatchBrowserEvent('toggleSidebarmodel');
   
    }
    public $userConnected;
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
    public function mount(){
        $this->userConnected = Auth::guard('utilisateur')->user()->id;
    }
    public function render()
    {
        
        return view('livewire.component.menu-utilisateur',[
            'ticketcounts' => ticket::where('utilisateur_id',$this->userConnected)->get(),
            'checkoutocunt' => Incident::where('utilisateur_id',$this->userConnected)->get(),
            'reservationcount' => checkoutreserver::where('responsable_id',$this->userConnected)->get(),
            'incidentcount' => Incident::where('utilisateur_id',$this->userConnected)->get(),



        ]);
    }
}
