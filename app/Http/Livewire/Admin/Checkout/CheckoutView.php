<?php

namespace App\Http\Livewire\Admin\Checkout;

use App\Models\chat;
use App\Models\Checkout as CheckoutModel;
use App\Models\Peripherique;
use App\Models\utilisateur;
use Livewire\Component;
use App\Models\Commentaire;
use App\Models\ordinateur;
use App\Models\TelephoneTablette;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Momemail;

class CheckoutView extends Component
{
    public $checkoutId;
    public $message;
    public $currentStep;
    public $comments;
    public $selectedvalsdata;
    public $checkouts;
    public $selectEquipement;

    public $affichecommentaire = True;
    public $affichestep = False;


    public function afficheretape()
    {
        $this->affichestep = !$this->affichestep;

    }


    public function EnvoyerMessage(Chat $chat)
    {
        //$chat = Chat::find($this->profilId);
        $utilisateurs = utilisateur::findOrFail($this->checkouts->utilisateur->id);
        $chat->targetmsg_id = $utilisateurs->matricule;
        $chat->utilisateur_id = Auth::user()->id;
        $chat->type = "user"; // type user(pour le sendeur) ou agent(pour  le recepteur)
        $chat->message = $this->message;
        $chat->save();


        $data = [
            'title' => 'Information',
            'message' => 'Vous avez une nouvelle message sur GPI Pivot ' . $this->message

        ];

        Mail::to('leoncerado@gmail.com')->send(new Momemail($data));

        $this->reset(['message']);
        $this->emit("refreshComponent");


    }

    public function changercomment()
    {
        $this->affichecommentaire = !$this->affichecommentaire;

    }
    public function RenouvelerCheckout($id)
    {
        $checkout = CheckoutModel::find($id);
        $checkout->statut = 2;
        //$ticket->archive = true;

        $checkout->save();

        $this->reset(['currentStep']);
        $this->currentStep = 2;
        $this->emitSelf('refreshComponent');
    }


    public function RefuserCheckout($id)
    {
        $checkout = CheckoutModel::find($id);
        $checkout->statut = 4;
        $checkout->save();
        $this->reset(['currentStep']);
        $this->currentStep = 4;
        $this->emitSelf('refreshComponent');
        $this->emitSelf('refreshComponent');
        return redirect()->back()->with('success', 'Vous ete sur!');
    }

    public $progress;
    public $current = [
        1 => 'current',
        2 => 'future',
        3 => 'future',
        4 => 'future',

    ];

    public function validerequipement()
    {
        //dd($this->selectedvalsdata,$this->checkoutId);
        CheckoutModel::where('id', $this->checkoutId)->update([
            'equipement_id' => $this->selectedvalsdata,
        ]);

        $checkouts = CheckoutModel::find($this->checkoutId);

        if($checkouts->materiel_type == "ordinateur"){
            ordinateur::where('id',$checkouts->equipement_id)->update(['statut'=>'En service']);
        }
        if($checkouts->materiel_type == "Telephone"){
            TelephoneTablette::where('id',$checkouts->equipement_id)->update(['statut'=>'En service']);
        }
        if($checkouts->materiel_type == "Peripherique"){
            Peripherique::where('id',$checkouts->equipement_id)->update(['statut'=>'En service']);
        }
        $this->emitSelf('refreshComponent');
        return redirect('/admin/checkout-view-' . $this->checkoutId);
    }
    public function modelstep(CheckoutModel $checkout)
    {
        $checkout = CheckoutModel::find($this->checkoutId);
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
            for ($i = 1; $i <= 3; $i++) {
                if ($i < $this->currentStep) {
                    $this->current[$i] = "past";
                } elseif ($i == $this->currentStep) {
                    $this->current[$i] = "current";
                } else {
                    $this->current[$i] = "future";
                }
            }

        }

        //$this->emitSelf('refreshComponent');
    }
    public function RemoveCheckout($id){
        CheckoutModel::destroy($id);
        return redirect('/admin/checkout');
    }

    public function nextStep()
    {
        $this->modelstep(CheckoutModel::find($this->checkoutId));
        if ($this->currentStep == 4) {
            return;
        } elseif ($this->currentStep < 4) {
            CheckoutModel::where('id', $this->checkoutId)->update(['statut' => $this->currentStep + 1]);
        }

        $checkouts = CheckoutModel::find($this->checkoutId);

        
        if( $checkouts->materiel_type == 'ordinateur'){
            if($checkouts->statut == 3){

                ordinateur::where('id',$checkouts->equipement_id)->update([
                    'statut' => 'En service'
                ]);
            }
             if($checkouts->statut == 4){

                ordinateur::where('id',$checkouts->equipement_id)->update([
                    'statut' => 'Disponible'
                ]);
            }
        }
        if($checkouts->materiel_type == 'telephone')

            if($checkouts->statut == 3){

                TelephoneTablette::where('id',$checkouts->equipement_id)->update([
                    'statut' => 'En service'
                ]);
            }
             if($checkouts->statut == 4){

                TelephoneTablette::where('id',$checkouts->equipement_id)->update([
                    'statut' => 'Disponible'
                ]);
            }
    }
    public function markResolved(){
      
        $checkouts = CheckoutModel::find($this->checkoutId);
        $checkouts->statut = 3;
        $checkouts->save();
        $this->modelstep(CheckoutModel::find($this->checkoutId));
        if($checkouts->materiel_type == 'ordinateur'){
            ordinateur::where('id',$checkouts->equipement_id)->update(['statut'=>"En stock"]);
        }
        if($checkouts->materiel_type == 'telephone'){
            TelephoneTablette::where('id',$checkouts->equipement_id)->update(['statut'=>"En stock"]);
        }
        $this->emit('refreshComponent');
    }
    public function markResolvedetabime(){
        $checkouts = CheckoutModel::find($this->checkoutId);
        $checkouts->statut = 4;
        $checkouts->save();
        $this->modelstep(CheckoutModel::find($this->checkoutId));
        if($checkouts->materiel_type == 'ordinateur'){
            ordinateur::where('id',$checkouts->equipement_id)->update(['statut'=>"En réparation"]);
        }
        if($checkouts->materiel_type == 'telephone'){
            TelephoneTablette::where('id',$checkouts->equipement_id)->update(['statut'=>"En réparation"]);
        }
        $this->emit('refreshComponent');
    
    }
    public function previousStep()
    {
        if ($this->currentStep == 1) {
            return;
        } else {
            for ($i = 3; $i >= 1; $i--) {
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
        CheckoutModel::where('id', $this->checkoutId)->update(['statut' => $this->currentStep - 1]);
        // dd($this->current);
    }
    public function mount($id)
    {
        $this->checkoutId = $id;
        $this->progress;
        $this->current;
        $this->selectEquipement;
        $this->checkouts = CheckoutModel::findOrFail($this->checkoutId);
        // $this->currentStep;
        $this->selectedvalsdata;
        $this->affichestep;

    }

    public function destroyComment($id)
    {
        Commentaire::destroy($id);

    }
    public function selectevals($vals)
    {
        $this->selectedvalsdata = $vals;
    }
    public function postCommentaire(Commentaire $commentaire)
    {
        if (!$this->comments) {

        } else {

            $commentaire->checkout_id = $this->checkoutId;
            $commentaire->utilisateur_id = Auth::user()->id;
            //$commentaire->responsable_id = Auth::user()->id ;

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
    public function render()
    {
        $this->modelstep(CheckoutModel::find($this->checkoutId));
        $utilisateurs = utilisateur::findOrFail($this->checkouts->utilisateur->id);
        return view('livewire.admin.checkout.checkout-view', [
            "utilisateurs" => $utilisateurs,
            "commentaires" => $this->checkouts
                ->commentaires()
                ->orderBy('created_at', 'desc')
                ->paginate(2),
            "TelephoneTablettes" => TelephoneTablette::
                where('statut', 'En stock')->
                where("type", "like", "%" . $this->selectEquipement . "%")->get(),
                "Peripheriques" => Peripherique::  where('statut', 'En stock')->get(),
            "ordinateurs" => ordinateur::
             where('statut', 'En stock')->
            where("nom", "like", "%" . $this->selectEquipement . "%")->get(),
            "Chats" => chat::where(function ($query) {
                $userId = Auth::user()->id;
                $query->where('utilisateur_id', $userId)
                    ->orWhere('targetmsg_id', $userId);
            })
                ->where(function ($query) use ($utilisateurs) {
                    $query->where('targetmsg_id', $utilisateurs->matricule)
                        ->orWhere('utilisateur_id', $utilisateurs->matricule);
                })
                ->orderBy('created_at', 'asc')
                ->get()
        ]);
    }
}
