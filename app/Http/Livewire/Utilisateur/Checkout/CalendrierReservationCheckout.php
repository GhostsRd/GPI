<?php

namespace App\Http\Livewire\Utilisateur\Checkout;

use Livewire\Component;
use App\Models\checkoutreserver as reserverEquipement;
use Illuminate\Support\Facades\Auth;
use App\Models\ordinateur;
class CalendrierReservationCheckout extends Component
{
     protected $listeners = [
        'refreshComponent' => '$refresh', // <- écoute l’événement
    ];

    public $filre_calendrier = "";
    public $reserverId;
    public $selectedEquipements;
    public $type_materiel;
    
      public $datedeb;
    public $datefin;

    public $commentaire;

    public $nbequipement;
    public $equipement_id;
   public $selectedMateriles;
   public $selectedId;
    public function visualiser($id){
        $this->selectedId = $id;

        $resEquipement = reserverEquipement::findOrFail($id);
        $this->datedeb = $resEquipement->date_deb;

        $this->dispatchBrowserEvent('open-light-modal');
    
        //dd($id);


    }
    public function mount($id,$type){
        $this->reserverId = $id;
        $this->type_materiel = $type;
        $this->selectedEquipements;
        $this->datedeb;

        //$this->;
    }

    public function openReservationModal($type,$id)
{   
    $this->type_materiel = $type;
    $this->equipement_id = $id;
   
    $this->equipement_type = $type;
    if($type == "ordinateur"){
        $this->selectedEquipements = ordinateur::where('id',$id)->get();
    }
   
    //$this->emitSelf('refrese');
    // Ensuite tu peux émettre l’événement JS pour ouvrir le modal
    $this->dispatchBrowserEvent('openModal');

}

    
    public function ModifierReservation(){

        $resEquipement = reserverEquipement::findOrFail($this->selectedId);
        $resEquipement->statut = 1; //mis algo milla atao ato hiverifiena hoe mis mireserver io zavatra io
        $resEquipement->date_debut = $this->datedeb;
        $resEquipement->date_fin = $this->datefin;
        $resEquipement->commentaire = $this->commentaire;
        $resEquipement->equipement_nombre = $this->nbequipement;
        $resEquipement->save();
        return redirect('/utilisateur-checkout-'. $this->reserverId.'-'. $resEquipement->equipement_type) ;
    }
    public function reserverEquipement(reserverEquipement $resEquipement){
 
        $resEquipement->equipement_type = $this->equipement_type;
        $resEquipement->equipement_id = $this->equipement_id;
        $resEquipement->responsable_id = Auth::guard('utilisateur')->user()->id;
        $resEquipement->statut = 1; //mis algo milla atao ato hiverifiena hoe mis mireserver io zavatra io
        $resEquipement->date_debut = $this->datedeb;
        $resEquipement->date_fin = $this->datefin;
        $resEquipement->commentaire = $this->commentaire;
        $resEquipement->equipement_nombre = $this->nbequipement;
        $resEquipement->save();
       
       $this->emit('refreshComponent');
        $this->emitSelf('refreshComponent'); 
       // $this->dispatchBrowserEvent('closeReservationModal');

    }
   public function render()
{
    // Récupère tous les événements correspondant à l'équipement
    $events = reserverEquipement::where('equipement_id', $this->reserverId)
        ->where('equipement_type', $this->type_materiel)
        ->get();

    // Récupère uniquement le premier événement selon le type de matériel
    $firstEvent = null; // <-- null par défaut

    if($this->type_materiel == "ordinateur"){
        $firstEvent = ordinateur::where('id', $this->reserverId)->first();
    } elseif($this->type_materiel == "imprimante"){
        $firstEvent = ordinateur::where('id', $this->reserverId)->first();
    }
    // ajouter d'autres types si besoin


    $lastEvent = reserverEquipement::where('equipement_id', $this->reserverId)
    ->where('equipement_type', $this->type_materiel)
    ->orderBy('date_fin','desc') // ou ->orderBy('id', 'desc')
    ->first();


    return view('livewire.utilisateur.checkout.calendrier-reservation-checkout', [
        'events' => $events,
        'firsts' => $firstEvent,
        'lastEvent' => $lastEvent,
        'historiques' => reserverEquipement::where('responsable_id', Auth::guard('utilisateur')->user()->id)
            ->orderBy('created_at','desc')
            ->get(),
           "selectedMateriels" => reserverEquipement::where('id',$this->selectedId)->get(),
    ]);
}

}
