<?php

namespace App\Http\Livewire\Utilisateur\Checkout;

use App\Models\TelephoneTablette;
use Livewire\Component;
use App\Models\checkoutreserver as reserverEquipement;
use Illuminate\Support\Facades\Auth;
use App\Models\ordinateur;
use Illuminate\Support\Facades\Mail;
use App\Mail\Momemail;
use Carbon\Carbon;
class CalendrierReservationCheckout extends Component
{
    protected $listeners = [
        'refreshComponent' => '$refresh', // <- écoute l’événement
        'refreshCalendar' => '$refresh',
        'updateEventDate' => 'updateEventDate',
        'visualiser' => 'visualiser'
    ];


    public $editable = False;
    public $filre_calendrier = "";
    public $reserverId;
    public $selectedEquipements;
    public $userConnected;
    public $type_materiel;

    public $datedeb;
    public $datefin;

    public $commentaire;

    public $nbequipement;
    public $equipement_id;
    public $selectedMateriles;
    public $selectedId;




  
    public function  ModifierView($id){


       // $this->selectedId = $id;
        //$resEquipement = reserverEquipement::findOrFail($this->selectedId);
        //$this->datedeb = $resEquipement->date_deb;
        $this->dispatchBrowserEvent('closeLightModal');
        //$this->dispatchBrowserEvent('openModifModal');
    }
    public function visualiser($id)
    {

        //$this->dispatchBrowserEvent('closeModal');
        $this->selectedId = $id;
        $resEquipement = reserverEquipement::findOrFail($this->selectedId);
        $this->datedeb = $resEquipement->date_deb;
        $this->dispatchBrowserEvent('lightview');

        //dd($id);


    }
    public function updateEventDate($data)
    {
        $event = reserverEquipement::find($data['id']);

        if ($event->responsable->id == $this->userConnected) {

            $startDate = \Carbon\Carbon::parse($data['start'])
                ->timezone('Indian/Antananarivo') // ou config('app.timezone')
                ->format('Y-m-d');
            //  dd($data['end']);
            if (is_null($data['end'])) {
                $endDate = \Carbon\Carbon::parse($data['start'])->timezone('Indian/Antananarivo')->format('Y-m-d');
            } else {
                $endDate = \Carbon\Carbon::parse($data['end'])->timezone('Indian/Antananarivo')->format('Y-m-d');
            }

            if ($event) {
                $event->update([
                    'date_debut' => $startDate,
                    'date_fin' => $endDate, // si pas de fin
                ]);
    
                //$this->dispatch('eventUpdated'); // Optionnel pour afficher un message
            }
            $this->emit('refreshComponent');
            
        }else{
             $this->emit('refreshComponent');
             
        }

    }
   

    public function openReservationModal($type, $id)
    {
        $this->type_materiel = $type;
        $this->equipement_id = $id;

        $this->equipement_type = $type;
        if ($type == "ordinateur") {
            $this->selectedEquipements = ordinateur::where('id', $id)->get();
        }

        //$this->emitSelf('refrese');
        // Ensuite tu peux émettre l’événement JS pour ouvrir le modal
        $this->dispatchBrowserEvent('openModal');

    }


    public function ModifierReservation()
    {

        $resEquipement = reserverEquipement::findOrFail($this->selectedId);
        $resEquipement->statut = 1; //mis algo milla atao ato hiverifiena hoe mis mireserver io zavatra io
        $resEquipement->date_debut = $this->datedeb;
        $resEquipement->date_fin = $this->datefin;
        $resEquipement->commentaire = $this->commentaire;
        $resEquipement->equipement_nombre = $this->nbequipement;
        $resEquipement->save();
        return redirect('/utilisateur-checkout-' . $this->reserverId . '-' . $resEquipement->equipement_type);
    }
    public function SAVEreserverEquipement(reserverEquipement $resEquipement)
    {


        if(Carbon::parse($this->datedeb)->toDateString() >= now()->toDateString()) {

            $resEquipement->equipement_type = $this->type_materiel;
            $resEquipement->equipement_id = $this->equipement_id;
            $resEquipement->responsable_id = Auth::guard('utilisateur')->user()->id;
            $resEquipement->statut = 1; //mis algo milla atao ato hiverifiena hoe mis mireserver io zavatra io
            $resEquipement->date_debut = $this->datedeb;
            $resEquipement->date_fin = $this->datefin;
            $resEquipement->commentaire = $this->commentaire;
            $resEquipement->equipement_nombre = $this->nbequipement;
            $resEquipement->save();

        //     $data = [
       // 'title' => 'Reservation',
        //'message' => 'Vous avez une nouvelle reservation de materiels type: '. $resEquipement->equipement_type

         //];
         //Mail::to('leoncerado@gmail.com')->send(new Momemail($data));
        }else{
            return;
        }


        


       return redirect('/utilisateur-checkout-' . $this->reserverId . '-' . $resEquipement->equipement_type);
        // $this->dispatchBrowserEvent('closeReservationModal');

    }
    public function AnnulerReservation($id){
         $resEquipement = reserverEquipement::findOrFail($id);
         $resEquipement->statut = 0;
         $resEquipement->save();
        $this->emit('refreshComponent');
       
    }
     public function mount($id, $type)
    {
        $this->reserverId = $id;
        $this->type_materiel = $type;
        $this->selectedEquipements;
        $this->datedeb;
        $this->userConnected = Auth::guard('utilisateur')->user()->id;
        $this->editable;
        //$this->;
    }
    public function render()
    {
        // Récupère tous les événements correspondant à l'équipement
        $events = reserverEquipement::where('equipement_id', $this->reserverId)
            ->where('equipement_type', $this->type_materiel)
            ->get();

        // Récupère uniquement le premier événement selon le type de matériel
        $firstEvent = null; // <-- null par défaut

        if ($this->type_materiel == "ordinateur") {
            $firstEvent = ordinateur::where('id', $this->reserverId)->first();
        } elseif ($this->type_materiel == "telephone") {
            $firstEvent = TelephoneTablette::where('id', $this->reserverId)->first();
        }
        // ajouter d'autres types si besoin


        $lastEvent = reserverEquipement::where('equipement_id', $this->reserverId)
            ->where('equipement_type', $this->type_materiel)
            ->orderBy('date_fin', 'desc') // ou ->orderBy('id', 'desc')
            ->first();
        
            $prochaines = reserverEquipement::where('responsable_id', Auth::guard('utilisateur')->user()->id)
            ->where('equipement_type', $this->type_materiel)
            ->where('date_debut','>' , now())
            ->orderBy('date_fin', 'desc') // ou ->orderBy('id', 'desc')
            ->first();
        


        return view('livewire.utilisateur.checkout.calendrier-reservation-checkout', [
            'events' => $events,
            'firsts' => $firstEvent,
            'lastEvent' => $lastEvent,
            'historiques' => reserverEquipement::where('responsable_id', Auth::guard('utilisateur')->user()->id)
                ->orderBy('created_at', 'desc')
                ->get(),
            'prochaines' => $prochaines,
            "selectedMateriels" => reserverEquipement::where('id', $this->selectedId)->get(),
        ]);
    }

}
