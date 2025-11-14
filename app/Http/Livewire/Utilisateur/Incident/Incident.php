<?php

namespace App\Http\Livewire\Utilisateur\Incident;

use App\Models\Checkout;
use App\Models\ordinateur;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Incident as IncidentModel;
use Livewire\WithFileUploads;


class Incident extends Component
{
    use WithFileUploads;
    protected $listeners = ['refreshComponent'=> '$refresh'];
    public $equipement_type;
    public $equipement_id;
    public  $userConnected;
    public $incident_sujet;
    public $incident_description;
    public $incident_nature;
    public $rapport_path;
    public $declaration_perte_path;
    public $rapport_incident;
    
    public $declaration_perte;
    public $selectedID;
    public $selectedIncidents;

  
   
    public function annulationDemande($id){
        $incident =IncidentModel::findOrFail($id);
        $incident->statut = 0;
        $incident->save();
                
        $this->emit('refreshComponent');

    }
    public function visualiser($id){
        $this->selectedID = $id;

        $this->selectedIncidents = IncidentModel::findOrFail($this->selectedID);
    }

    public function mount(){
        $this->userConnected = Auth::guard("utilisateur")->user()->id;
        $this->equipement_type;
        $this->selectedIncidents ;
    }
    public function store(IncidentModel $incident){
          $this->validate([
            'equipement_type' => 'required',
            'equipement_id' => 'required',
            'rapport_incident' => 'required|file|mimes:pdf,jpg,png,docx|max:2048',
            'declaration_perte' => 'nullable|file|mimes:pdf,jpg,png,docx|max:2048',
        ]);
       
        if ($this->rapport_incident) {
            // Enregistre le fichier dans storage/app/public/rapports/
            $rapport_path = $this->rapport_incident->store('rapport_incident', 'public');
            $declaration_perte_path = $this->declaration_perte->store('declaration_perte', 'public');
           
        }

        $incident->equipement_type = $this->equipement_type;
        $incident->equipement_id = $this->equipement_id;
        $incident->utilisateur_id = Auth::guard("utilisateur")->user()->id;
        $incident->incident_sujet = $this->incident_sujet;
        $incident->incident_nature = $this->incident_nature;
        $incident->incident_description = $this->incident_description;
        $incident->declaration_perte = $declaration_perte_path;
        $incident->rapport_incident =  $rapport_path;
        $incident->save();
        
        $this->emit('refreshComponent');
        $this->reset(['equipement_type','incident_sujet','incident_nature','incident_description','declaration_perte','rapport_incident']);
    }
    public function render()
    {
        return view('livewire.utilisateur.incident.incident',[
            'incidents' => IncidentModel::where('utilisateur_id',$this->userConnected)->orderBy('id','desc')->get(),
            'checkouts' => Checkout::where('utilisateur_id',$this->userConnected)
            ->where('statut','!=',1)->get(),
            'Incidentsrecentes' => IncidentModel::where('utilisateur_id',$this->userConnected)->orderBy('id','desc')->limit(2)->get(),
        ]);
        //////////////////////////////////////////////////checkout type eto zao e 
    }
}
