<?php

namespace App\Http\Livewire\Admin\Incident;

use App\Models\TelephoneTablette;
use Livewire\Component;
use App\Models\Incident;
use App\Models\Commentaire;
use Illuminate\Support\Facades\Auth;
class IncidentView extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];
    public $incidentId;


    public $currentStep;
    public $affichecommentaire = True;
    public $affichestep = False;
    public $comments;
    public $progress;
    public $incidents;
    public $current = [
        1 => 'current',
        2 => 'future',
        3 => 'future',
        4 => 'future',
        5 => 'future',


    ];
    public function refuserIncindent(){
    
    }
    public function modelstep(Incident $incident)
    {

        $this->currentStep = $incident->statut;

        $this->current[$this->currentStep] = "current";
        $prog = $this->currentStep * 20;
        $progress = 'fill_' . $prog;
        $this->progress = $progress;

        if ($this->currentStep == 3) {
            for ($i = 1; $i < 3; $i++) {
                $this->current[$i] = "past";
            }
        } else {
            for ($i = 1; $i <= 4; $i++) {
                if ($i < $this->currentStep) {
                    $this->current[$i] = "past";
                } elseif ($i == $this->currentStep) {
                    $this->current[$i] = "current";
                } else {
                    $this->current[$i] = "future";
                }
            }

        }

        $this->emit('refreshComponent');
    }
    public function afficheretape()
    {
        $this->affichestep = !$this->affichestep;

    }
    public function rapport_incident(){
         $incident = Incident::findOrFail($this->incidentId);
        return redirect('storage/' . $incident->rapport_incident);
    }
    public function declaration_perte(){
         $incident = Incident::findOrFail($this->incidentId);
        return redirect('storage/' . $incident->declaration_perte);
    }
    public function previousStep()
    {
        $incident = Incident::findOrFail($this->incidentId);
        $this->modelstep($incident);
        if ($this->currentStep == 1) {
            return;
        } else {
            for ($i = 4; $i >= 1; $i--) {
                if ($this->current[$this->currentStep] == "current" && $i > 1) {
                    $this->current[$this->currentStep] = "future";
                    $this->current[$this->currentStep - 1] = "current";
                    $prog = ($i - 1) * 20;
                    $progress = 'fill_' . $prog;
                    $this->progress = $progress;
                    break;
                }
                $this->emit('refreshComponent');
            }
        }
        // Incident::where('id', $this->incidentId)->update(['statut' => $this->currentStep - 1]);
        // dd($this->current);

        $incident->statut = $this->currentStep - 1;
        $incident->save();


    }
    public function changercomment()
    {
        $this->affichecommentaire = !$this->affichecommentaire;

    }

    public function nextStep()
    {
        $this->modelstep(Incident::find($this->incidentId));
        if ($this->currentStep == 4) {
            return;
        } elseif ($this->currentStep < 4) {
            Incident::where('id', $this->incidentId)->update(['statut' => $this->currentStep + 1]);
        }

        $incidentvals = Incident::find($this->incidentId);

        if($incidentvals->equipement_type == 'Telephone'){
            if($incidentvals->statut == 2){
                TelephoneTablette::where('id',$incidentvals->equipement_id)->update([
                    'statut' => 'En réparation',
                ]);
            }
            if($incidentvals->statut == 3){
                 TelephoneTablette::where('id',$incidentvals->equipement_id)->update([
                    'statut' => 'En stock',
                ]);
            }
            if($incidentvals->statut == 4){
                 TelephoneTablette::where('id',$incidentvals->equipement_id)->update([
                    'statut' => 'Hors service',
                ]);
            }
        }
        

    }

    public function postCommentaire(Commentaire $commentaire)
    {
        if (!$this->comments) {

        } else {

            //  $commentaire->checkout_id = $this->checkoutId;
            $commentaire->utilisateur_id = Auth::user()->id;
            $commentaire->incident_id = $this->incidentId;

            $commentaire->etat = $this->currentStep;
            $commentaire->commentaire = $this->comments;
            $commentaire->save();

            $this->comments = "";

            $this->emitSelf('refreshComponent');

        }

        // session()->flash('message','Commentaire ajouter avec succes');
        //  return redirect()->to('/admin-ticket-view/'.$this->ticketId);

    }
    public function marknonResolved()
    {
        $this->modelstep(Incident::find($this->incidentId));
        Incident::where('id', $this->incidentId)->update(['statut' => 4]);
        $this->emitSelf('refreshComponent');

    }
    public function markResolved()
    {
        $this->modelstep(Incident::find($this->incidentId));
        Incident::where('id', $this->incidentId)->update(['statut' => 3]);
        $this->emitSelf('refreshComponent');
    }
    public function mount($id)
    {
        $this->progress;
        $this->affichestep;
        $this->currentStep;
        $this->current;
        $this->affichecommentaire;
        $this->incidentId = $id;
        $this->incidents = Incident::findOrFail($this->incidentId);
    }
   public function destroyComment($id){

    Commentaire::destroy($id);
    $this->emit('refreshComponent');
   }
    public function render()
    {
        $this->modelstep(Incident::find($this->incidentId));
        return view(
            'livewire.admin.incident.incident-view',

            [
                "commentaires" => $this->incidents
                    ->commentaire()
                    ->orderBy('created_at', 'desc')
                    ->paginate(2),
            ]
        );
    }
}
