<?php

namespace App\Http\Livewire\Utilisateur\Checkout;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\checkoutreserver as reserverEquipement;
use App\Models\ordinateur;
use App\Models\TelephoneTablette;
class MesReservationCalendrier extends Component
{
    public $reserverId;
    public $recherche;
    public $selectedId;
    public $userConnected;    

      

    public function reserverMat($type,$id){
          return redirect('/utilisateur-checkout-'. $id.'-'.$type);
    }
    public function visualiser($id){
        $vals = reserverEquipement::find($id);
        return redirect('/utilisateur-checkout-'. $vals->equipement_id.'-'.$vals->equipement_type);
    }
    public function mount(){
          $this->userConnected = Auth::guard('utilisateur')->user()->id;
    }

    public function render()
    {
       
        $events = reserverEquipement::where('responsable_id', $this->userConnected)
            ->get();
         $lastEvent = reserverEquipement::where('responsable_id', $this->userConnected)
            ->where('date_debut','>' , now())
            ->orderBy('date_fin', 'desc') // ou ->orderBy('id', 'desc')
            ->limit(5)
            ->get();
            
            
            $ordinateurs = ordinateur::where('nom', "like","%".$this->recherche."%")
               ->where('statut','!=','Hors service')
            ->get();
            $telephones = TelephoneTablette::where('nom', "like","%".$this->recherche."%")
            ->where('statut','!=','Hors service')
            ->get();

            $firstEvent = reserverEquipement::where('responsable_id', $this->userConnected)->first();
    
        return view('livewire.utilisateur.checkout.mes-reservation-calendrier',
        [
             'events' => $events,
              'firsts' => $firstEvent,
              'lastEvent' => $lastEvent,
              'ordinateurs' => $ordinateurs,
              'telephones'=> $telephones,
               'historiques' => reserverEquipement::where('responsable_id', $this->userConnected)
                ->orderBy('created_at', 'desc')
                ->get(),
                "selectedMateriels" => reserverEquipement::where('id', $this->selectedId)->get(),
        ]
    );
    }
}
