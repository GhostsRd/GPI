<?php

namespace App\Http\Livewire\Admin\Checkout;

use App\Models\Checkout;
use App\Models\checkoutreserver;
use App\Models\Commentaire;
use App\Models\ordinateur;
use App\Models\utilisateur;
use Livewire\Component;
use App\Models\checkoutreserver as matreservation;
use Illuminate\Support\Facades\Auth;
use App\Models\TelephoneTablette;


class ReservationView extends Component
{
  protected $listeners = ['refreshComponent'=> '$refresh'];
  public $reservationID;
  public $progress;
  public $message;
  public $currentStep;
  public $comments;
  public $selectedvalsdata;
  public $checkouts;
  public $selectEquipement;
  public $materiel_type;
  public $matreservations;
  public $current = [
    1 => 'current',
    2 => 'future',
    3 => 'future',
    4 => 'future',
    5 => 'future',


  ];
  public $affichecommentaire = True;
  public $affichestep = False;
  public function afficheretape()
  {
    $this->affichestep = !$this->affichestep;

  }

  public function modelstep(matreservation $checkout)
  {
    $checkout = matreservation::find($this->reservationID);
    $this->currentStep = $checkout->statut;

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



  public function nextStep()
  {
    $this->modelstep(matreservation::find($this->reservationID));
    if ($this->currentStep == 4) {
      return;
    } elseif ($this->currentStep < 4) {
      matreservation::where('id', $this->reservationID)->update(['statut' => $this->currentStep + 1]);
    }

    $reservations = matreservation::find($this->reservationID);

    if ($reservations->equipement_type == 'telephone') {
      if ($reservations->statut == 3) {
        TelephoneTablette::where('id', $reservations->equipement_id)->update([
          'statut' => 'En service',
        ]);
      }
      if ($reservations->statut == 4) {
        TelephoneTablette::where('id', $reservations->equipement_id)->update([
          'statut' => 'En stock',
        ]);
      }

    }

    if ($reservations->equipement_type == 'ordidnateur') {
      if ($reservations->statut == 3) {
        ordinateur::where('id', $reservations->equipement_id)->update([
          'statut' => 'En service',
        ]);
      }
      if ($reservations->statut == 4) {
        ordinateur::where('id', $reservations->equipement_id)->update([
          'statut' => 'En stock',
        ]);
      }

    }



  }
  public function previousStep()
  {
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
        $this->emitSelf('refreshComponent');
      }
    }
    matreservation::where('id', $this->reservationID)->update(['statut' => $this->currentStep - 1]);
    // dd($this->current);
    $this->emitSelf('refreshComponent');
  }
  public function postCommentaire(Commentaire $commentaire)
  {
    if (!$this->comments) {

    } else {

      //  $commentaire->checkout_id = $this->checkoutId;
      $commentaire->utilisateur_id = Auth::user()->id;
      $commentaire->reservation_id = $this->reservationID;

      $commentaire->etat = $this->currentStep;
      $commentaire->commentaire = $this->comments;
      $commentaire->save();

      $this->comments = "";
      $this->reset(['selectedvalsdata']);
      $this->emitSelf('refreshComponent');
      $this->emitTo('Utilisateur.utilisateur-ticket', 'refreshComponent');
    }

    // session()->flash('message','Commentaire ajouter avec succes');
    //  return redirect()->to('/admin-ticket-view/'.$this->ticketId);

  }
  public function changercomment()
  {
    $this->affichecommentaire = !$this->affichecommentaire;

  }


  public function mount($id)
  {
    $this->reservationID = $id;
    $this->matreservations = matreservation::findOrFail($this->reservationID);
    $this->progress;
    $this->current;
    $this->selectEquipement;

    // $this->currentStep;
    $this->selectedvalsdata;
    $this->affichestep;
    $this->materiel_type;
  }
  public function RemoveReservation($id)
  {
    matreservation::destroy($id);
    return redirect('/admin/checkout-reservation-list');
  }
  public function markResolved()
  {
    

    matreservation::where('id', $this->reservationID)->update(['statut' => 4]);
    $this->modelstep(matreservation::find($this->reservationID));
    $mat = matreservation::find( $this->reservationID);

    if($mat->equipement_type == "ordinateur"){
      ordinateur::where('id',$mat->equipement_id)->update(['statut'=>'En stock']);
    }
    if($mat->equipement_type == "telephone"){
      TelephoneTablette::where('id',$mat->equipement_id)->update(['statut'=>'En stock']);
    }
    $this->emit('refreshComponent');
  }
  public function markResolvedWithErrorMAt()
  {

     matreservation::where('id', $this->reservationID)->update(['statut' => 5]);
     $this->modelstep(matreservation::find($this->reservationID));
    $mat = matreservation::find( $this->reservationID);

    if($mat->equipement_type == "ordinateur"){
      ordinateur::where('id',$mat->equipement_id)->update(['statut'=>'En réparation']);
    }
    if($mat->equipement_type == "telephone"){
      TelephoneTablette::where('id',$mat->equipement_id)->update(['statut'=>'En réparation']);
    }
    $this->emit('refreshComponent');

  }
  public function destroyComment($id){
    Commentaire::destroy($id);

    $this->emit('refreshComponent');
  }
  public function archived()
  {
    $this->modelstep(matreservation::find($this->reservationID));
    matreservation::where('id', $this->reservationID)->update(['statut' => 5]);
    $this->emitSelf('refreshComponent');
  }
  public function render()
  {
    $this->modelstep(matreservation::find($this->reservationID));
    return view(
      'livewire.admin.checkout.reservation-view',
      [

        'checkouts' => Checkout::get(),
        'utilisateurs' => utilisateur::get(),
        "commentaires" => $this->matreservations
          ->commentaires()
          ->orderBy('created_at', 'desc')
          ->paginate(2),
      ]
    );
  }
}
